<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

        $user->wallet += 50;
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
            $owner->wallet += 400;
            $owner->save();

            $fighter->user_id = $newUserId;
            $fighter->updated_at = now();

            $fighter->save();

            $user->wallet -= 400;
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

    public function generateAvatarDescription($text) {

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
