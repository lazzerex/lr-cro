<?php

use App\Http\Controllers\SettingsController;
use App\Models\Post;
use Gpc\FilamentComponents\Greetr;
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

Route::get('/greet/{name}', function($sName) {
    $oGreetr = new Greetr();
    return $oGreetr->greet($sName);
});

Route::get('/posts', function () {
    $posts = Post::query()->paginate();

    return view('posts.index', [
        'posts' => $posts,
    ]);
});

Route::get('/posts/{id}', function ($id) {
    $post = Post::query()->find($id);

    return view('posts.detail', [
        'post' => $post,
    ]);
});

Route::get('/settings', SettingsController::class);