<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GPTService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function gptRequest($prompt) {

        $apiURL = 'https://api.openai.com/v1/chat/completions';

        $headers = [
            'Authorization' => 'Bearer ' . config('services.open_ai.api_key'),
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->withoutVerifying()->post($apiURL, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ["role" => "user", "content" => $prompt]
            ],
            'temperature' => 0.7,
            'n' => 1
        ]);

        $responseData = $response->json();

        // Check if 'choices' key exists in the response
        if (!isset($responseData['choices'][0]['message']['content'])) {
            // Log the full response to debug
            Log::error('Unexpected OpenAI API Response:', $responseData);
            return 'Error generating content from OpenAI API.';
        }

        // Return the message content
        return $responseData['choices'][0]['message']['content'];
    }

}
