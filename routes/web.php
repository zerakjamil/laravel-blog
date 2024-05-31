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
//Users
Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisterController::class, 'create'])->name('register');
        Route::post('register', [RegisterController::class, 'store'])->name('store');
        Route::get('login', [SessionController::class, 'loginView'])->name('login');
        Route::post('login', [SessionController::class, 'login'])->name('login');
    });
    Route::post('logout', [SessionController::class , 'destroy'])->name('logout')->middleware('auth');
});

//Posts
Route::get('/', [ PostController::class , 'index'])->name('home');
Route::name('posts.')->prefix('posts')->group(function (){
    Route::get('{post:slug}' , [PostController::class , 'show'])->name('post');
    Route::post('{post:slug}/addcomment', [CommentController::class , 'store'])->name('addcomment')->middleware('auth');
});



//Category
Route::get('category/{category:slug}', [PostController::class , 'categoryIndex'])->name('category');

//Author
Route::get('authors/{author:username}', [PostController::class , 'index'])->name('authors');

//Admin
Route::name('admin.')->prefix('admin')->middleware('admin')->group(function () {
    Route::name('posts.')->prefix('posts')->group(function (){
        Route::get('create' , [AdminPostController::class , 'create'])->name('create');
        Route::get('/' , [AdminPostController::class , 'index'])->name('index');
        Route::post('/' , [AdminPostController::class , 'store'])->name('store');
        Route::get('{post}/edit' , [AdminPostController::class , 'edit'])->name('edit');
        Route::patch('{post}' , [AdminPostController::class , 'update'])->name('update');
        Route::delete('{post}' , [AdminPostController::class , 'destroy'])->name('delete');
    });

});


Route::fallback(function(){
    return 'pages doesnt exist';
});
