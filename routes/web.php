<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::get('/', HomeController::class);

Route::get('/chuyen-muc/{category:slug}', CategoryController::class)->name('category');

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