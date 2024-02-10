<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::middleware('can:admin')->group(function () {

    Route::get('admin/posts', [AdminPostController::class, 'index'])->name('admin_posts');
    Route::post('admin/posts', [AdminPostController::class, 'store']);
    Route::get('admin/posts/create', [AdminPostController::class, 'create'])->name('post');
    Route::get('admin/posts/{post:slug}/edit', [AdminPostController::class, 'edit'])->name('edit_post');
    Route::patch('admin/posts/{post:slug}', [AdminPostController::class, 'update'])->name('update_post');
    Route::delete('admin/posts/{post:slug}', [AdminPostController::class, 'destroy'])->name('delete_post');
});
