<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\PostsController;
use Illuminate\Auth\Events\Login;
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

Route::get('/', [PostsController::class, 'index'])->name('home');
Route::get('/category/{category}', [PostsController::class, 'category'])->name('home.category');

Route::get('/post/{id}', [PostsController::class, 'post'])->name('post');
Route::post('/post/{id}', [PostsController::class, 'comment'])->name('post.comment');
Route::post('/vote/{id}', [PostsController::class, 'vote'])->name('post.vote');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
Route::delete('/logout', [LogoutController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/posts/create', [CreatePostController::class, 'index'])->name('posts.create');
Route::post('/posts/create', [CreatePostController::class, 'create']);


