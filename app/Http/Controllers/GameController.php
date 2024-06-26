<?php

namespace App\Http\Controllers;

use App\Events\GameEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Game;

class GameController extends Controller
{

    public function index() {

        if (!auth()->user()) {
            abort(404);
        }

        return view('create_fight');

    }

    public function join()
    {
        if (!auth()->user()) {
            abort(404);
        }

        $game = new Game;
        $game->code = Str::random(6);
        $game->save();
        // Attache l'utilisateur actuellement connecté au jeu
        $game->users()->attach(auth()->id());

        return redirect()->route('game.show', $game->code);

    }

    public function joinWithCode(Request $request)
    {

        if (!auth()->user()) {
            abort(404);
        }

        $code = $request->input('code');
        $game = Game::where('code', $code)->first();

        if (!$game) {

            return redirect()->back()->with('error', 'Invalid room code.');

        }

        if (!$game->users->contains(auth()->id())) {
            $game->users()->attach(auth()->id());

            event(new GameEvent(['message' => 'Un nouveau joueur a rejoint la salle!', 'code' => $game->code, 'newPlayerName' => auth()->user()->name, 'level' => auth()->user()->level]));

        }

        return redirect()->route('game.show', $game->code);

    }

    public function show($code)
    {
        $game = Game::where('code', $code)->with('users')->firstOrFail();

        if (!$game->users->contains(auth()->id())) {

            $game->users()->attach(auth()->id());

            event(new GameEvent(['message' => 'Un nouveau joueur a rejoint la salle!', 'code' => $game->code, 'newPlayerName' => auth()->user()->name, 'level' => auth()->user()->level]));

        }


        return view('fight', ['game' => $game]);
    }


}
