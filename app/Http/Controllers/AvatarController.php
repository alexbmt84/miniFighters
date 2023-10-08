<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Models\Marketplace;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{

    public function index() {

        $userId = auth()->id();

        $fighters = Fighter::query()->where('user_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('avatars', compact('fighters'));

    }

    public function home() {

        $fighters = Fighter::all();

        return view('home', compact('fighters'));

    }

    public function fighter($id) {

        $userId = auth()->id();

        $fighter = Fighter::findOrFail($id);

        $fighterId = $fighter->id;

        $name = $fighter->name;

        $avatar = '/storage/' . $fighter->avatar_path;

        $isMyFighter = $this->isMyFighter($userId, $fighterId);

        $isInMarketPlace = Marketplace::isInMarketPlace($fighterId);

        return view('fighter', compact('fighter', 'name', 'avatar', 'isMyFighter', 'isInMarketPlace'));

    }

    private function getOpenAIResponse($prompt)
    {
        $client = new Client();

        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer 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',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [['role' => 'user', 'content' => $prompt]],
                'temperature' => 0.7
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (isset($data['choices'][0]['message']['content'])) {
            return $data['choices'][0]['message']['content'];
        }

        return null;
    }

    public function generateAvatarDescription($text) {

        $client = new Client([
            'verify' => false  // Désactiver la vérification SSL si nécessaire
        ]);

        $response = $client->post('https://api.deepai.org/api/text-generator', [
            'headers' => [
                'api-key' => 'd3cbe5fd-4117-4e37-ae34-b6373fe6f93e'
            ],
            'multipart' => [
                [
                    'name'     => 'text',
                    'contents' => $text
                ]
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);


        if (isset($data['output'])) {
            return $data['output'];
        }
        return null;
    }

    function generateUniqueString($longueur = 12) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++) {
            $indexAleatoire = rand(0, strlen($caracteres) - 1);
            $chaineAleatoire .= $caracteres[$indexAleatoire];
        }
        return $chaineAleatoire;
    }

    public function generateAvatar($name) {

        $client = new Client([
            'verify' => false
        ]);

        $response = $client->get('https://api.multiavatar.com/' . $name . '.png');

        return $response->getBody()->getContents();

    }

    public function generateFantasyAvatar($text) {

        $type = "superhero";

        $client = new Client([
            'verify' => false  // Désactiver la vérification SSL si nécessaire
        ]);

        $response = $client->post('https://api.deepai.org/api/cyber-beast-generator', [
            'headers' => [
                'api-key' => 'd3cbe5fd-4117-4e37-ae34-b6373fe6f93e'
            ],
            'multipart' => [
                [
                    'name'     => 'text',
                    'contents' => $text
                ],
                [
                    'name'     => 'grid_size',
                    'contents' => '1'
                ]
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (isset($data['output_url'])) {
            return file_get_contents($data['output_url']);
        }
        return null;
    }

    public function generatePerc($prompt) {

        $client = new Client();

        $apiKey = "SG_92b91b7598ff95b1";  // Store this in your .env file and retrieve with env('YOUR_API_KEY')
        $url = "https://api.segmind.com/v1/kandinsky2.2-txt2img";

        $data = [
            "prompt" => $prompt,
            "negative_prompt" => "lowres, text, letters, letter, error, cropped, white monochrome background, white background, white bg, empty background, monochrome background",
            "samples" => 1,
            "num_inference_steps" => 25,
            "img_width" => 512,
            "img_height" => 768,
            "prior_steps" => 25,
            "seed" => 9863172,
            "base64" => true
        ];

        try {
            $response = $client->post($url, [
                'json' => $data,
                'headers' => [
                    'x-api-key' => $apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);

            return $response->getBody()->getContents(); // retourne les données de l'image directement

        } catch (\Exception $e) {
            // Handle exceptions, perhaps log them and return a meaningful error to the user
            return response($e->getMessage(), 500);
        }
    }

    public function generateRPG($prompt) {

        $client = new Client([
            'verify' => false  // Désactiver la vérification SSL si nécessaire
        ]);

        $apiKey = "SG_92b91b7598ff95b1";  // Store this in your .env file and retrieve with env('YOUR_API_KEY')
        $url = "https://api.segmind.com/v1/sdxl1.0-txt2img";

        $data = [
            "prompt" => $prompt,
            "negative_prompt" => "lowres, text, letters, letter, error, cropped, white monochrome background, white background, white bg, empty background, monochrome background, multiple characters, anime, cartoon, realist, photography, ugly, tiling, poorly drawn hands, poorly drawn feet, poorly drawn face, out of frame, extra limbs, disfigured, deformed, body out of frame, blurry, bad anatomy, blurred, watermark, grainy, signature, cut off, draft",
            "samples" => 1,
            "scheduler" => "ddim",
            "num_inference_steps" => 25,
            "guidance_scale" => 9,
            "seed" => 9863172,
            "img_width" => 512,
            "img_height" => 768,
            "base64" => false
        ];

        try {
            $response = $client->post($url, [
                'json' => $data,
                'headers' => [
                    'x-api-key' => $apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);

            return $response->getBody()->getContents(); // retourne les données de l'image directement

        } catch (\Exception $e) {
            // Handle exceptions, perhaps log them and return a meaningful error to the user
            return response($e->getMessage(), 500);
        }
    }

    private function callAPI($prompt) {
        $apiURL = 'https://api.openai.com/v1/chat/completions';

        $headers = [
            'Authorization' => 'Bearer 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', // replace with your actual key
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->post($apiURL, [
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

    public function store(Request $request) {

        $user = auth()->user();
        $userId =$user->id;

        if ($user->wallet < 200 ) {
            return redirect()->back();
        }

        $user->wallet -= 200;
        $user->save();

        // With unique string for MultiAvatars
        $uniqueName = $this->generateUniqueString();

        $name = $request->input('name');
        $description = $request->input('description');

        if($description && strlen($description) > 3) {

            // $specialMovePrompt = "Generate a unique special description for a fighter named " . $name . ". It could be any type of hero, just give a description that will be used to generate the portrait of this fighter.";
            $specialMovePrompt = "Envision a fighter based on the name '" . $name . "'. $name has some characteristics already : $description. This fighter will be part of a cards game and it could be a superhero with astonishing abilities, a feared gangster from dark alleyways, a mystical hero of legend, a futuristic cyborg, a simple civilian if he/she is having a first and last name that sounds like human or any other formidable and striking figure that you want to imagine. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, not unfinished.";

        } else {

            // $specialMovePrompt = "Generate a unique special description for a fighter named " . $name . ". It could be any type of hero, just give a description that will be used to generate the portrait of this fighter.";
           // HERO $specialMovePrompt = "Envision a fighter based on the name '" . $name . "'. This fighter will be part of a cards game and it can be a superhero with astonishing abilities, a feared gangster from dark alleyways, a mystical hero of legend, a futuristic cyborg, a simple civilian if he/she is having a first and last name that sounds like human or any other formidable and striking figure that you want to imagine. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, not unfinished.";
            // $specialMovePrompt = "Generate a unique special description for a fighter named " . $name . ". It could be any type of hero, just give a description that will be used to generate the portrait of this fighter.";
           // Civilian
            $specialMovePrompt = "Envision a civilian based on the name '" . $name . "'. This civilian will have some abilities and is in a cards game that will contain some super-heroes, mystic characters, gangsters and . $name . will be a civilian in this game. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, creative and structured.";
        }

        //$specialMovePrompt = "Envision a character based on the name '" . $name . "'. This character will be part of a cards game. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation.";
        $specialDescription = $this->generateAvatarDescription($specialMovePrompt);

        $translateMovePrompt = "Please translate this description in French : " . $specialDescription;
        $translateDescription = $this->generateAvatarDescription($translateMovePrompt);

        $avatarData = $this->generatePerc($specialDescription . " sharp focus, illustration, highly detailed, digital painting, concept art, matte, masterpiece");

        // Enregistrement temporaire des données de l'avatar
        $tempPath = tempnam(sys_get_temp_dir(), 'fighter');
        file_put_contents($tempPath, $avatarData);

        // Convertir le fichier temporaire en instance UploadedFile
        $file = new UploadedFile($tempPath, $uniqueName . '.png', null, null, true);

        // Stockage de l'avatar dans le disque public
        $dir = "fighters";
        $filename = $uniqueName . '.jpg';
        $file->storeAs($dir, $filename, 'public');

        $filePath = $dir . '/' . $filename;

        $hp = rand(20, 100);

        $firstAttack = floor(rand(10, $hp) / 2);
        $secondAttack = floor(($hp - $firstAttack) / 2);

        $wordlists = include resource_path('wordlist.php');

          /*      $attackNames = [];

                for ($i = 0; $i < 2; $i++ ) {

                    $randomNoun = $wordlists['nouns'][array_rand($wordlists['nouns'])];
                    $randomAdjective = $wordlists['adjectives'][array_rand($wordlists['adjectives'])];
                    $randomEnd = $wordlists['ending'][array_rand($wordlists['ending'])];

                    $attackNames[] = $randomNoun . ' ' . $randomAdjective . ' ' . $randomEnd;

                }

                $attackName1 = $attackNames[0];
                $attackName2 = $attackNames[1];*/

        $attackName1 = $this->callAPI("Your responses should be a sentence or two, unless the user’s request requires reasoning or long-form outputs. En 20 mots, Génère moi 1 'Attaque 1 : ' et sa description, basées sur cette description du combattant : $translateDescription.");
        $attackName2 = $this->callAPI("Your responses should be a sentence or two, unless the user’s request requires reasoning or long-form outputs. En 20 mots, Génère moi 1 'Attaque 2 : ' et sa description, basées sur cette description du combattant : $translateDescription. (Différente de $attackName1)");

        // Stockez le chemin et le nom dans la base de données
        $fighter = Fighter::create([
            'name' => $name,
            'avatar_path' => $filePath,
            'hp' => $hp,
            'attack_name_1' => $attackName1,
            'attack_name_2' => $attackName2,
            'attack_damages_1' => $firstAttack,
            'attack_damages_2' => $secondAttack,
            'user_id' => $userId,
            'description' => $translateDescription
        ]);

        $isMyFighter = $this->isMyFighter($userId, $fighter->id);
        $isInMarketPlace = Marketplace::isInMarketPlace($fighter->id);

        return view('fighter', ['avatar' => Storage::url($filePath)], compact('name', 'fighter', 'isMyFighter', 'isInMarketPlace'));
    }

    public function isMyFighter($userId, $fighterId) {

        $query = Fighter::query()
            ->where('user_id', $userId)
            ->where('id', $fighterId)
            ->first();


        if ($query) {
            return true;
        } else {
            return false;
        }

    }

    public function delete($fighterId) {

        $user = auth()->user();

        Fighter::query()->where('id', $fighterId)->delete();

        $user->wallet += 50;
        $user->save();

        return redirect('/avatars');

    }

    public function sell($fighterId) {

        Fighter::listForSale($fighterId);

        return redirect('/marketplace');

    }

    public function buy($fighterId) {

        $user = auth()->user();
        $newUserId = auth()->id();

        $fighter = Fighter::find($fighterId);

        if ($user->wallet >= 400) {

            $ownerId = $fighter->user_id;
            $owner = User::find($ownerId);
            $owner->wallet +=400;
            $owner->save();

            $fighter->user_id = $newUserId;
            $fighter->updated_at = now();

            $fighter->save();

            $user->wallet -=400;
            $user->save();

            Marketplace::where('fighter_id', $fighterId)->delete();

        } else {

            return redirect('/marketplace');

        }


        return redirect('/avatars');

    }

}
