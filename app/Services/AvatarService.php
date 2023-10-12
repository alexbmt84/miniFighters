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

        //Last Modif
        //9863172 Original Seed
        //4078969122 Last Seed
        $data = [
            "prompt" => $prompt,
            "negative_prompt" => "lowres, text, letters, letter, error, cropped, white monochrome background, white background, white bg, empty background, monochrome background, realism, photography, hyper realist",
            "samples" => 1,
            "num_inference_steps" => 50,
            "img_width" => 512,
            "img_height" => 768,
            "prior_steps" => 25,
            "seed" => 1602850129,
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
