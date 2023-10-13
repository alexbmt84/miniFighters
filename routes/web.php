<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\FriendshipController;
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

Route::get('/avatars', [AvatarController::class, 'index'])->name('avatars')->middleware(['auth']);
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace')->middleware(['auth']);
Route::post('/generate', [AvatarController::class, 'store'])->name('generate')->middleware(['auth']);
Route::get('/fighter/{id}', [AvatarController::class, 'findFighter'])->name('fighter');
Route::get('/fight', [FightController::class, 'index'])->name('fight')->middleware(['auth']);
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware(['auth']);

Route::post('/sell/{fighterId}', [AvatarController::class, 'sell'])->middleware(['auth']);
Route::post('/buy/{fighterId}', [AvatarController::class, 'buy'])->middleware(['auth']);
Route::post('/remove/{fighterId}', [MarketplaceController::class, 'delete'])->middleware(['auth']);
Route::delete('/delete/{fighterId}', [AvatarController::class, 'delete'])->middleware(['auth']);

Route::get('/arena', [GameController::class, 'join'])->name('fight')->middleware(['auth']);
Route::get('/arena/{code}', [GameController::class, 'show'])->name('game.show')->middleware(['auth']);
Route::post('/arena/join', [GameController::class, 'joinWithCode'])->name('game.joinWithCode')->middleware(['auth']);

Route::get('/fight', [GameController::class, 'index'])->name('create.fight')->middleware(['auth']);

Route::get('/profile/{name}', [ProfileController::class, 'findUserProfile'])->name('find.profile')->middleware(['auth']);

Route::post('/game/leave/{code}', [GameController::class, 'leave'])->name('game.leave')->middleware(['auth']);


Route::middleware(['web'])->group(function () {

    Broadcast::routes();

    Broadcast::channel('miniFighters.{code}', function ($user, $code) {
        // Vérifications pour voir si $user peut accéder à la salle $code.
        // True, l'utilisateur sera autorisé. Sinon, il sera refusé.
        return true; // Pour l'instant, tous les utilisateurs autorisés.
    });
});

Route::middleware(['auth'])->group(function () {
    Route::post('/friend/request/{user}', [FriendshipController::class, 'send'])->name('friend.request');
    Route::post('/friend/accept/{user}', [FriendshipController::class, 'accept'])->name('friend.accept');
    Route::delete('/friend/decline/{user}', [FriendshipController::class, 'decline'])->name('friend.decline');
    Route::get('/friends', [FriendshipController::class, 'index'])->name('friends.index');
    Route::post('/save-avatar', [ProfileController::class, 'saveAvatar']);
});


require __DIR__.'/auth.php';
