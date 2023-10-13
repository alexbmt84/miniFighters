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

        if(!auth()->user()) {
            abort(404);
        }

        $myName = auth()->user()->name;

        if (strtolower($name) == strtolower($myName)) {
            return redirect('/profile');
        }

        $user = User::query()->where('name', $name)->first();

        if(!$user) {
            abort(404);
        }

        $userId = $user->id;

        $fighters = Fighter::query()->where('user_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('usersAvatars', compact('fighters', 'user'));

    }

    public function saveAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        auth()->user()->update(['avatar' => $avatarPath]);
        return response()->json(['message' => 'Avatar uploaded successfully!']);
    }

}
