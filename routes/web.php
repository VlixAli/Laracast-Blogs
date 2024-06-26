<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SessionController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('posts/{post:slug}', 'show');
});

Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store'])
    ->middleware('verified');

Route::post('newsletter', NewsletterController::class);

Route::controller(RegisterController::class)
    ->middleware('guest')->prefix('register')->group(function () {
        Route::get('/', 'create');
        Route::post('/', 'store');
    });

Route::controller(SessionController::class)->group(function () {
    Route::middleware('guest')->prefix('login')->group(function () {
        Route::get('/', 'create');
        Route::post('/', 'store')->name('login');
    });

    Route::post('logout', 'destroy')->middleware('auth');
});

Route::controller(EmailVerificationController::class)
    ->prefix('/email')->middleware('auth')->group(function () {
        Route::prefix('/verify')->group(function () {
            Route::get('/', 'show')
                ->name('verification.notice');
            Route::get('/{id}/{hash}', 'verify')
                ->middleware('signed')
                ->name('verification.verify');
        });

        Route::post('/verification-notification', 'resend')
            ->middleware('throttle:6,1')
            ->name('verification.send');
    });

Route::controller(ResetPasswordController::class)
    ->middleware('guest')->group(function () {
        Route::prefix('/forgot-password')->group(function () {
            Route::get('/', 'create')->name('password.request');

            Route::post('/', 'store')->name('password.email');
        });

        Route::prefix('/reset-password')->group(function () {
            Route::get('/', 'show')->name('reset-password-sent');

            Route::get('/{token}', 'createResetPassword')->name('password.reset');

            Route::post('/', 'storeResetPassword')->name('password.update');
        });

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
