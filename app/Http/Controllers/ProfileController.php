<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('profile');
    }

    public function findUserProfile($name) {

        $user = User::query()->where('name', $name)->first();
        $userId = $user->id;

        $fighters = Fighter::query()->where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('usersAvatars', compact('fighters', 'user'));

    }

}
