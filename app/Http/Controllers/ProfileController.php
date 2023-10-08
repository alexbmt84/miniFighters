<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {

        if (!auth()->user()) {
            abort(404);
        }

        return view('profile');
    }

    public function findUserProfile($name) {

        $user = User::query()->where('name', $name)->first();

        if(!$user) {
            abort(404);
        }

        $userId = $user->id;

        $fighters = Fighter::query()->where('user_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('usersAvatars', compact('fighters', 'user'));

    }

}
