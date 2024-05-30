<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
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
//Posts
Route::get('/', [ PostController::class , 'index'])->name('home');
Route::get('/post/{post:slug}' , [PostController::class , 'show'])->name('post');
Route::get('/posts/register' ,[RegisterController::class, 'create'])->middleware('guest');
Route::post('/posts/register' ,[RegisterController::class, 'store'])->middleware('guest');
Route::get('/posts/login' ,[SessionController::class, 'loginView'])->middleware('guest');
Route::post('/posts/login' ,[SessionController::class, 'login'])->name('login')->middleware('guest');
Route::post('/posts/logout', [SessionController::class , 'destroy'])->name('logout')->middleware('auth');
Route::post('/posts/{post:slug}/addcomment', [CommentController::class , 'store'])->name('addcomment')->middleware('auth');

//Category
Route::get('category/{category:slug}', [PostController::class , 'categoryIndex'])->name('category');

//Author
Route::get('authors/{author:username}', [PostController::class , 'index'])->name('authors');

//Admin

Route::group(['prefix' => 'admin' , 'middleware' => 'can:admin'] , function () {
    Route::get('/posts/create' , [AdminPostController::class , 'create'])->name('admin.create.post');
    Route::get('/posts' , [AdminPostController::class , 'index'])->name('admin.index.post');
    Route::post('/post' , [AdminPostController::class , 'store']);
    Route::get('/posts/{post}/edit' , [AdminPostController::class , 'edit'])->name('admin.posts.edit');
    Route::patch('/posts/{post}' , [AdminPostController::class , 'update'])->name('admin.posts.update');
    Route::delete('/posts/{post}' , [AdminPostController::class , 'destroy'])->name('admin.posts.delete');
});


Route::fallback(function(){
    return 'pages doesnt exist';
});
