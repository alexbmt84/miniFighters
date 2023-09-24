<?php

namespace App\Http\Controllers;

use App\Events\GameEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Game;

class GameController extends Controller
{

    public function index() {
        return view('create_fight');
    }

    public function join()
    {
        $game = new Game;
        $game->code = Str::random(6);
        $game->save();

        // Attache l'utilisateur actuellement connecté au jeu
        $game->users()->attach(auth()->id());

        return redirect()->route('game.show', $game->code);

    }

    public function joinWithCode(Request $request)
    {
        $code = $request->input('code');
        $game = Game::where('code', $code)->first();

        if (!$game) {

            return redirect()->back()->with('error', 'Invalid room code.');

        }

        if (!$game->users->contains(auth()->id())) {
            $game->users()->attach(auth()->id());

            event(new GameEvent(['message' => 'Un nouveau joueur a rejoint la salle!', 'code' => $game->code, 'newPlayerName' => auth()->user()->name]));

        }

        return redirect()->route('game.show', $game->code);

    }

    public function show($code)
    {
        $game = Game::where('code', $code)->with('users')->firstOrFail();

        if (!$game->users->contains(auth()->id())) {

            $game->users()->attach(auth()->id());

            event(new GameEvent(['message' => 'Un nouveau joueur a rejoint la salle!', 'code' => $game->code, 'newPlayerName' => auth()->user()->name]));

        }


        return view('fight', ['game' => $game]);
    }





}
