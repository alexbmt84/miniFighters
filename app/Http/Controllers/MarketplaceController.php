<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Models\Marketplace;
use App\Models\User;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{

    public function index() {

        if (!auth()->user()) {
            abort(404);
        }

        $authenticatedUser = auth()->user();
        $fightersId = Marketplace::query()->pluck('fighter_id');

        if (!$fightersId->isEmpty()) {

            $fighters = Fighter::query()->whereIn('id', $fightersId)->orderBy('updated_at', 'desc')->get();
            $userId = Marketplace::query()->where('fighter_id', $fightersId->first())->value('user_id');

            if ($userId) {

                $user = User::query()->find($userId);

            } else {

                $user = null;

            }

        } else {

            $fighters = collect();  // Une collection vide
            $user = null;

        }

        return view('marketplace', compact('fighters', 'authenticatedUser', 'user'));

    }

    public function delete($fighterId) {

        if (!auth()->user()) {
            abort(404);
        }

        $user = auth()->user();

        Marketplace::query()->where('fighter_id', $fighterId)->delete();

        return redirect('/avatars');

    }

}
