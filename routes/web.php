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



Route::get('/post/{id}', [PostsController::class, 'post'])->name('post');
Route::get('/search', [PostsController::class, 'search'])->name('post.search');
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
Route::post('/dashboard/updatepassword', [DashboardController::class, 'passwordUpdate'])->name('password.update');
Route::get('/user/{id}', [DashboardController::class, 'user'])->name('user');
Route::delete('/dashboard/deleteaccount', [DashboardController::class, 'deleteAccount'])->name('user.delete');
Route::delete('/dashboard/post/delete/{id}', [DashboardController::class, 'deletePost'])->name('post.delete');
Route::get('/dashboard/post/update/{id}', [DashboardController::class, 'editPost'])->name('post.edit');
Route::put('/dashboard/post/update/{id}', [DashboardController::class, 'updatePost'])->name('post.update');
Route::post('/dashboard/comment/{id}', [DashboardController::class, 'editComment'])->name('comment.edit');
Route::delete('/dashboard/comment/{id}', [DashboardController::class, 'deleteComment'])->name('comment.delete');


Route::get('/posts/create', [CreatePostController::class, 'index'])->name('posts.create');
Route::post('/posts/create', [CreatePostController::class, 'create']);


Route::get('/{sort?}', [PostsController::class, 'index'])->name('home');
Route::get('/category/{category}/{sort?}', [PostsController::class, 'category'])->name('home.category');

