<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});

//Ajouter les routes correspondant à chacune des méthodes du contrôleur :
Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);

//Routes pour liker, unliker, voir les notifs
Route::get('/posts/like/{post}', [PostController::class, 'like'])->name('posts.like');
Route::get('/posts/dislike/{post}', [PostController::class, 'dislike'])->name('posts.dislike');
Route::get('/posts/notif/{user}', [PostController::class, 'notif'])->name('posts.notif');

require __DIR__.'/auth.php';
