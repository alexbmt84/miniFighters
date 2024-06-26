<?php

namespace App\Services;

use GuzzleHttp\Client;

class AvatarService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            // Disable SSL Verification
            'verify' => false,
        ]);
    }

    public function kandinskyRequest($prompt)
    {

        $apiKey = config('services.segmind.api_key');
        $url = "https://api.segmind.com/v1/kandinsky2.2-txt2img";

        //Last Modif
        //9863172 Original Seed
        //4078969122 2nd Seed
        //1602850129 Last seed
        $data = [
            "prompt" => $prompt,
            "negative_prompt" => "lowres, text, letters, letter, error, cropped, white monochrome background, white background, white bg, empty background, monochrome background, realism, photography, poorly drawn, bad anatomy, wrong anatomy, extra limb, missing limb, floating limbs, mutated hands and fingers, disconnected limbs, mutation, mutated, ugly, disgusting, blurry, amputation",
            "samples" => 1,
            "num_inference_steps" => 50,
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

    public function rpgRequest($prompt)
    {

        $apiKey = config('services.segmind.api_key');
        $url = "https://api.segmind.com/v1/sd1.5-rpg";

        //Last Modif
        //9863172 Original Seed
        //4078969122 2nd Seed
        //1602850129 Last seed
        $data = [
            "prompt" => $prompt,
            "negative_prompt" => "lowres, text, letters, letter, error, cropped, white monochrome background, white background, white bg, empty background, monochrome background, realism, photography, poorly drawn, bad anatomy, wrong anatomy, extra limb, missing limb, floating limbs, mutated hands and fingers, disconnected limbs, mutation, mutated, ugly, disgusting, blurry, amputation",
            "scheduler" => "UniPC",
            "num_inference_steps" => "50",
            "guidance_scale" => "9",
            "samples" => "1",
            "seed" => "9784982262",
            "img_width" => "512",
            "img_height" => "768",
            "prior_steps" => "25",
            "base64" => false
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
