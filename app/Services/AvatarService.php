<?php

namespace App\Services;

use GuzzleHttp\Client;

class AvatarService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function kandinskyRequest($prompt)
    {

        $apiKey = config('services.segmind.api_key');
        $url = "https://api.segmind.com/v1/kandinsky2.2-txt2img";

        $data = [
            "prompt" => $prompt,
            "negative_prompt" => "lowres, text, letters, letter, error, cropped, white monochrome background, white background, white bg, empty background, monochrome background, photography",
            "samples" => 1,
            "num_inference_steps" => 25,
            "img_width" => 512,
            "img_height" => 768,
            "prior_steps" => 25,
            "seed" => 9863172,
            "base64" => true
        ];

        try {

            $response = $this->client->post($url, [
                'json' => $data,
                'headers' => [
                    'x-api-key' => $apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);

            return $response->getBody()->getContents();

        } catch (\Exception $e) {

            return response($e->getMessage(), 500);

        }

    }

}
