<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Models\Marketplace;
use App\Models\User;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{

    public function index() {

        $user = auth()->user();

        $fightersId = Marketplace::pluck('fighter_id');  // Pas besoin de 'all()' ici
        $userId = Marketplace::pluck('user_id');

        $user = User::query()->where('id', $userId)->first();

        $fighters = Fighter::whereIn('id', $fightersId)->get();

        return view('marketplace', compact('fighters', 'user'));

    }

    public function delete($fighterId) {

        $user = auth()->user();

        Marketplace::query()->where('fighter_id', $fighterId)->delete();

        return redirect('/avatars');

    }

}
