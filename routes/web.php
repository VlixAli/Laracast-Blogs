<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('posts/{post:slug}', 'show');
});

Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::controller(RegisterController::class)
    ->middleware('guest')->prefix('register')->group(function () {
        Route::get('/', 'create');
        Route::post('/', 'store');
    });

Route::controller(SessionController::class)->group(function () {
    Route::middleware('guest')->prefix('login')->group(function () {
        Route::get('/', 'create');
        Route::post('/', 'store');
    });

    Route::post('logout', 'destroy')->middleware('auth');
});

Route::controller(AdminPostController::class)
    ->middleware('can:admin')->group(function () {
        Route::get('admin/posts', 'index')->name('admin_posts');
        Route::post('admin/posts', 'store');
        Route::get('admin/posts/create', 'create')->name('post');
        Route::get('admin/posts/{post:slug}/edit', 'edit')->name('edit_post');
        Route::patch('admin/posts/{post:slug}', 'update')->name('update_post');
        Route::delete('admin/posts/{post:slug}', 'destroy')->name('delete_post');
    });
