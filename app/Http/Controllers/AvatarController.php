<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{

    public function index() {

        $userId = auth()->id();

        $fighters = Fighter::query()->where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('avatars', compact('fighters'));

    }


    public function home() {

        $fighters = Fighter::all();

        return view('home', compact('fighters'));

    }

    public function fighter($id) {

        $fighter = Fighter::findOrFail($id);

        $name = $fighter->name;

        $avatar = '/storage/' . $fighter->avatar_path;

        return view('fighter', compact('fighter', 'name', 'avatar'));

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


public function store(Request $request) {

    $user = auth()->user();
    $userId =$user->id;

    if ($user->wallet < 200 ) {
        return redirect()->back();
    }

    $user->wallet -= 200;
    $user->save();

    $uniqueName = $this->generateUniqueString();
    $name = $request->input('name');

    $avatarData = $this->generateAvatar($uniqueName);

    // Enregistrement temporaire des données de l'avatar
    $tempPath = tempnam(sys_get_temp_dir(), 'fighter');
    file_put_contents($tempPath, $avatarData);

    // Convertir le fichier temporaire en instance UploadedFile
    $file = new UploadedFile($tempPath, $uniqueName . '.png', null, null, true);

    // Stockage de l'avatar dans le disque public
    $dir = "fighters";
    $filename = $uniqueName . '.png';
    $file->storeAs($dir, $filename, 'public');

    $filePath = $dir . '/' . $filename;

    $hp = rand(20, 100);

    $firstAttack = floor(rand(10, $hp) / 2);
    $secondAttack = floor(($hp - $firstAttack) / 2);

    $wordlists = include resource_path('wordlist.php');

    $attackNames = [];

    for ($i = 0; $i < 2; $i++ ) {

        $randomNoun = $wordlists['nouns'][array_rand($wordlists['nouns'])];
        $randomAdjective = $wordlists['adjectives'][array_rand($wordlists['adjectives'])];
        $randomEnd = $wordlists['ending'][array_rand($wordlists['ending'])];

        $attackNames[] = $randomNoun . ' ' . $randomAdjective . ' ' . $randomEnd;

    }

    $attackName1 = $attackNames[0];
    $attackName2 = $attackNames[1];

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
    ]);

    return view('fighter', ['avatar' => Storage::url($filePath)], compact('name', 'fighter'));
}

public function delete($fighterId) {

    $user = auth()->user();

    Fighter::query()->where('id', $fighterId)->delete();

    $user->wallet += 50;
    $user->save();

    return redirect('/avatars');

}

}
