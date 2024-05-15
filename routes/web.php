<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('login', [SocialAuthController::class, 'login']);
Route::get('auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
Route::get('home', function () {
    return view('welcome');
});
