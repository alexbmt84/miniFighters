<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeepLService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function translateWithDeepl($text, $targetLang = 'FR')
    {
        $apiURL = 'https://api-free.deepl.com/v2/translate';
        $authKey = config('services.deepL_api.api_key');

        $headers = [
            'Authorization' => 'DeepL-Auth-Key ' . $authKey,
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->post($apiURL, [
            'text' => [$text],
            'target_lang' => $targetLang
        ]);

        $responseData = $response->json();

        // Check if 'translations' key exists in the response
        if (!isset($responseData['translations'][0]['text'])) {
            // Log the full response to debug
            Log::error('Unexpected DeepL API Response:', $responseData);
            return 'Error translating content with DeepL API.';
        }

        return $responseData['translations'][0]['text'];
    }

}
