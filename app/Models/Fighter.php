<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Type\Integer;

class Fighter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'avatar_path', 'hp', 'attack_name_1', 'attack_name_2', 'attack_damages_1', 'attack_damages_2', 'user_id', 'description'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function marketplace(): BelongsTo {
        return $this->belongsTo(Marketplace::class);
    }

    public static function deleteFighter($fighterId) {

        if (!auth()->user()) {
            abort(404);
        }

        $user = auth()->user();

        Fighter::query()->where('id', $fighterId)->delete();

        $user->incrementWallet(50);
        $user->save();

    }

    public static function sellFighter($fighterId) {

        if (!auth()->user()) {
            abort(404);
        }

        Fighter::listForSale($fighterId);

    }
    public static function buyFighter($fighterId)
    {

        if (!auth()->user()) {
            abort(404);
        }

        $user = auth()->user();
        $newUserId = auth()->id();

        $fighter = Fighter::find($fighterId);

        if ($user->wallet >= 400) {

            $ownerId = $fighter->user_id;
            $owner = User::find($ownerId);
            $owner->incrementWallet(400);
            $owner->save();

            $fighter->user_id = $newUserId;
            $fighter->updated_at = now();

            $fighter->save();

            $user->decrementWallet(400);
            $user->save();

            Marketplace::where('fighter_id', $fighterId)->delete();

        }

    }

    public static function isMyFighter($userId, $fighterId) {

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

    public static function findFighter($id) {

        $userId = auth()->id();
        $fighter = Fighter::findOrFail($id);
        $fighterId = $fighter->id;
        $name = $fighter->name;
        $avatar = '/storage/' . $fighter->avatar_path;

        $isMyFighter = Fighter::isMyFighter($userId, $fighterId);
        $isInMarketPlace = Marketplace::isInMarketPlace($fighterId);

        return [
            'fighter' => $fighter,
            'name' => $name,
            'avatar' => $avatar,
            'isMyFighter' => $isMyFighter,
            'isInMarketPlace' => $isInMarketPlace
        ];

    }

    public static function listForSale($fighterId) {

        $fighter = Fighter::query()->where('id', $fighterId)->first();

        if ($fighter->user_id == auth()->id()) {

            $listing = new Marketplace;
            $listing->fighter_id = $fighterId;
            $listing->user_id = auth()->id();
            $listing->price = 400;


            $listing->save();

        }

    }

    public static function makeFighterPrompt($name, $description, $type): String {

        switch ($type) {

            case 'Fighter':
                if($description && strlen($description) > 3) {
                    return "Envision a fighter based on the name '" . $name . "'. $name has some characteristics already : $description. This fighter will be part of a cards game and it could be a superhero with astonishing abilities, a feared gangster from dark alleyways, a mystical hero of legend, a futuristic cyborg, a simple civilian if he/she is having a first and last name that sounds like human or any other formidable and striking figure that you want to imagine. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, not unfinished.";
                } else {
                    return "Envision a fighter based on the name '" . $name . "'. This fighter will be part of a cards game and it can be a superhero with astonishing abilities, a feared gangster from dark alleyways, a mystical hero of legend, a futuristic cyborg, a simple civilian if he/she is having a first and last name that sounds like human or any other formidable and striking figure that you want to imagine. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, not unfinished.";
                }

            case 'Civilian':
                if($description && strlen($description) > 3) {
                    return "Envision an human civilian based on the name '" . $name . "'. $name has some characteristics already : $description. This civilian will have some abilities and is part of a world that will contain some super-heroes, mystic characters, gangsters, cyborgs, monsters. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, creative and structured.";
                } else {
                    return "Envision an human civilian based on the name '" . $name . "'. This civilian will have some abilities and is part of world that contains some super-heroes, mystic characters, gangsters, cyborgs, monsters. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, creative and structured.";
                }

            default:
                return "Envision a fighter based on the name '" . $name . "'. This fighter will be part of a cards game and it can be a superhero with astonishing abilities, a feared gangster from dark alleyways, a mystical hero of legend, a futuristic cyborg, a simple civilian if he/she is having a first and last name that sounds like human or any other formidable and striking figure that you want to imagine. Picture him/her with distinctive features that resonate with the essence of his/her name and his/her unique story. Craft a description that captures the imagination and provides a rich basis for his/her visual representation. Please make a creative description, around 50 words and make it complete, not unfinished.";

        }

    }

    public static function generateUniqueString($length = 12): String {

        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($chars) - 1);
            $randomString .= $chars[$randomIndex];
        }

        return $randomString;
    }

    public static function generateFighterHp() {
        $min = 100;
        $max = 1000;
        $bias = 2;  // Augmenter cette valeur pour rendre les scores élevés encore plus rares.
        $randValue = mt_rand($min, $max);
        return (int) ($min + pow(($randValue - $min) / ($max - $min), $bias) * ($max - $min));
    }

    public static function saveFighterAvatar($avatarData): String
    {

        // Enregistrement temporaire des données de l'avatar
        $tempPath = tempnam(sys_get_temp_dir(), 'fighter');
        file_put_contents($tempPath, $avatarData);

        // Unique file name generation
        $uniqueName = self::generateUniqueString();

        // Convertir le fichier temporaire en instance UploadedFile
        $file = new UploadedFile($tempPath, $uniqueName . '.png', null, null, true);

        // Stockage de l'avatar dans le disque public
        $dir = "fighters";
        $filename = $uniqueName . '.jpg';
        $file->storeAs($dir, $filename, 'public');

        return $dir . '/' . $filename;

    }

    // DEEPAI Text generator
    public function generateFighterDescription($text) {

        $client = new Client([
            'verify' => false  // Désactiver la vérification SSL si nécessaire
        ]);

        $response = $client->post('https://api.deepai.org/api/text-generator', [
            'headers' => [
                'api-key' => config('services.deep_ai.api_key')
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

}
