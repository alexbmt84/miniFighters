<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ProfileController;
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
Route::post('/generate', [AvatarController::class, 'store'])->name('generate');
Route::get('/fighter/{id}', [AvatarController::class, 'fighter'])->name('fighter');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::delete('/delete/{fighterId}', [AvatarController::class, 'delete']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
