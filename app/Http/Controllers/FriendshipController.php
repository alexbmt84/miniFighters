<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function send(User $user)
    {
        auth()->user()->sendFriendRequestTo($user);

        // Redirigez vers la page précédente avec un message
        return back()->with('success', 'Demande d\'ami envoyée.');
    }

    public function accept(User $user)
    {
        auth()->user()->acceptFriendRequestFrom($user);

        return back()->with('success', 'Demande d\'ami acceptée.');
    }

    public function decline(User $user)
    {
        auth()->user()->declineFriendRequestFrom($user);

        return back()->with('success', 'Demande d\'ami refusée.');
    }

    public function index()
    {
        $friends = auth()->user()->friends();
        $requests = auth()->user()->friendRequestsPending;

        return view('usersAvatars', compact('friends', 'requests'));
    }

}
