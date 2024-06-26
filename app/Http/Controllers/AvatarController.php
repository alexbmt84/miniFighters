<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Models\Marketplace;
use App\Services\AvatarService;
use App\Services\DeepLService;
use App\Services\GPTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{

    protected $avatarService;
    protected $gptService;
    protected $deeplService;

    public function __construct(AvatarService $avatarService, GPTService  $gptService, DeepLService $deeplService)
    {
        $this->avatarService = $avatarService;
        $this->gptService = $gptService;
        $this->deeplService = $deeplService;
    }

    public function index() {

        if (!auth()->user()) {
            abort(404);
        }

        $userId = auth()->id();
        $fighters = Fighter::query()->where('user_id', $userId)->orderBy('updated_at', 'desc')->get();

        foreach ($fighters as $fighter) {
            $fighter->isInMarketPlace = Marketplace::isInMarketPlace($fighter->id);
        }

        return view('avatars', compact('fighters'));
    }

    public function home() {

        $fighters = Fighter::all();

        return view('home', compact('fighters'));

    }

    public function findFighter($id) {

        $data = Fighter::findFighter($id);

        return view('fighter', [
            'fighter' => $data['fighter'],
            'name' => $data['name'],
            'avatar' => $data['avatar'],
            'isMyFighter' => $data['isMyFighter'],
            'isInMarketPlace' => $data['isInMarketPlace']
        ]);

    }

    public function callSegmind($prompt) {

        //return $this->avatarService->rpgRequest($prompt); // Carte magie ?
        return $this->avatarService->kandinskyRequest($prompt);

    }

    public function callGPT($prompt) {

        return $this->gptService->gptRequest($prompt);

    }

    public function callDeepL($translatePrompt) {
        return $this->deeplService->translateWithDeepl($translatePrompt);
    }

    public function store(Request $request) {

        if (!auth()->user()) {
            abort(404);
        }

        $user = auth()->user();
        $userId =$user->id;

        if ($user->wallet < 200 ) {
            return redirect()->back();
        }

        $type = $request->input('type');
        $name = $request->input('name');
        $description = $request->input('description');

        $gptPromptParam = 'Your responses should be a sentence or two, unless the user’s request requires reasoning or long-form outputs. You\'ll give me the output under a JSON format, like this example : {
            "Description": "Harley Queen, the enigmatic Queen of Chaos, strides through the shadows in an elegant black leather jumpsuit with purple accents. With her mischievous smile and piercing green eyes, she brandishes a pair of electrified tonfas, crackling with power. Her hair, a vibrant mix of crimson and platinum, cascades down her back, reflecting her dual nature. Beneath her enigmatic allure lies a mysterious past of loyalty, betrayal and vengeance.",
            "Attacks": ["Attack 1: Fulgurante Explosion - Super Blast generates a devastating blast of explosive energy that pulverizes its opponents.", "
            Attack 2: Celestial Detonation - Super Blast channels his explosive power to create a devastating shockwave that annihilates his enemies."],
            "Characteristics": {
                "Strength": 8,
                "Endurance": 7,
                "Intelligence": 6,
                "Agility": 7
            }
        }. Make sure you put the simple quotation marks in the right places and to follow strictly a Json format that will be decoded with PHP json_decode function.';

        $prompt = Fighter::makeFighterPrompt($name, $description, $type);
        $fighterDescription = $this->callGPT($prompt . " " . $gptPromptParam);
        $data = json_decode($fighterDescription, true);

        // LAST API MODIF
        $translatePrompt1 = $data['Description'];
        $translatePrompt2 = $data['Attacks'][0];
        $translatePrompt3 = $data['Attacks'][1];

        $translateDescription = $this->callDeepL($translatePrompt1);
        $attackName1 = $this->callDeepL($translatePrompt2);
        $attackName2 = $this->callDeepL($translatePrompt3);

        // Add modifs after Cartoon colors
        //$avatarData = $this->callSegmind($fighterDescription . " hd, 4k, artwork, sharp focus, illustration, highly detailed, digital painting, concept art, matte, masterpiece, full body pose");
        $avatarData = $this->callSegmind($data['Description'] . " digital artwork, highly detailed, high definitions, masterpiece, high definition, 8k, bokeh, sharp focus, matte, card game style, video game style, creative, cartoon colors, full body card game style, Magic The Gathering character style, fighter in action");
        $filePath = Fighter::saveFighterAvatar($avatarData);

        $hp = Fighter::generateFighterHp();
        $attack1 = floor(rand(100, $hp) / 2);
        $attack2 = floor(rand(100, 300));
        //$attack2 = floor(($hp - $attack1) / 2);

        $fighter = Fighter::query()->create([
            'name' => $name,
            'avatar_path' => $filePath,
            'hp' => $hp,
            'attack_name_1' => $attackName1,
            'attack_name_2' => $attackName2,
            'attack_damages_1' => $attack1,
            'attack_damages_2' => $attack2,
            'user_id' => $userId,
            'description' => $translateDescription
        ]);

        $isMyFighter = Fighter::isMyFighter($userId, $fighter->id);
        $isInMarketPlace = Marketplace::isInMarketPlace($fighter->id);

        $user->decrementWallet(200);

        return view('fighter', ['avatar' => Storage::url($filePath)], compact('name', 'fighter', 'isMyFighter', 'isInMarketPlace'));
    }

    public function delete($fighterId) {

        Fighter::deleteFighter($fighterId);

        return redirect('/avatars');

    }

    public function sell($fighterId) {

        Fighter::sellFighter($fighterId);

        return redirect('/marketplace');

    }

    public function buy($fighterId)
    {
        try {

            Fighter::buyFighter($fighterId);

            return redirect('/avatars');

        } catch (\Exception $e) {

            return redirect('/marketplace');

        }

    }

}
