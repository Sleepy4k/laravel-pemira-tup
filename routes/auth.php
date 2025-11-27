<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Unauthenticated Route
    |--------------------------------------------------------------------------
    |
    | You can list public endpoint for any user in here. These routes are meant
    | to be used for guests and are not guarded by any authentication system.
    | Remember not to list anything of importance, use authenticate route instead.
    */

    Route::resource('signin', Auth\SigninController::class)
        ->middleware('guest')
        ->only(['index', 'store'])
        ->name('index', 'signin');

    /*
    |--------------------------------------------------------------------------
    | Authenticated Route
    |--------------------------------------------------------------------------
    |
    | In here you can list any route for authenticated user. These routes
    | are meant to be used privately since the access is exclusive to authenticated
    | user who had obtained their access through the login process.
    */

    Route::delete('/logout', Auth\SignoutController::class)
        ->middleware('auth')
        ->name('logout');
});
