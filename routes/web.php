<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportWordPressController;
use App\Http\Controllers\PostController;
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

Route::get('/', HomeController::class)->name('home');
Route::get('/chuyen-muc/{category:slug}', CategoryController::class)->name('category');

// Route::get('/test', function () {
//     $posts = Post::query()
//         ->with('categories')
//         ->get();
//     foreach($posts as $post)
//     {
//         dd($post);
//     }
// });

Route::get('/{post:slug}', PostController::class)->name('post');


//Route::get('/importwp', ImportWordPressController::class);

