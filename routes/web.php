<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/avatars', [AvatarController::class, 'index'])->name('avatars');
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace');
Route::post('/generate', [AvatarController::class, 'store'])->name('generate');
Route::get('/fighter/{id}', [AvatarController::class, 'fighter'])->name('fighter');
Route::get('/fight', [FightController::class, 'index'])->name('fight');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/sell/{fighterId}', [AvatarController::class, 'sell']);
Route::post('/buy/{fighterId}', [AvatarController::class, 'buy']);
Route::post('/remove/{fighterId}', [MarketplaceController::class, 'delete']);
Route::delete('/delete/{fighterId}', [AvatarController::class, 'delete']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/arena', [GameController::class, 'join'])->name('fight');

Route::get('/arena/{code}', [GameController::class, 'show'])->name('game.show');

Route::post('/arena/join', [GameController::class, 'joinWithCode'])->name('game.joinWithCode');

Route::get('/fight', [GameController::class, 'index'])->name('create.fight');

Route::get('/profile/{name}', [ProfileController::class, 'findUserProfile'])->name('find.profile');

Route::post('/game/leave/{code}', [GameController::class, 'leave'])->name('game.leave');


Route::middleware(['web'])->group(function () {

    Broadcast::routes();

    Broadcast::channel('miniFighters.{code}', function ($user, $code) {
        // Vérifications pour voir si $user peut accéder à la salle $code.
        // True, l'utilisateur sera autorisé. Sinon, il sera refusé.
        return true; // Pour l'instant, tous les utilisateurs autorisés.
    });
});

require __DIR__.'/auth.php';
