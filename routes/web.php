<?php

use App\Http\Controllers\Landing;
use App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Dashboard\Batch;
use App\Http\Controllers\Dashboard\Voter;
use App\Http\Controllers\Dashboard\Session;
use App\Http\Controllers\Dashboard\Setting;
use App\Http\Controllers\Dashboard\Profile;
use App\Http\Controllers\Dashboard\Timeline;
use App\Http\Controllers\Dashboard\Candidate;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Storage\ServeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
|
| You can list public endpoint for any user in here. These routes are not guarded
| by any authentication system. In other words, any user can access it directly.
| Remember not to list anything of importance, use authenticate route instead.
*/

Route::get('/', Landing\HomeController::class)->name('landing');
Route::get('/faq', Landing\FaqController::class)->name('faq');
Route::get('/voting', Landing\VotingController::class)->name('voting');

Route::get('storage/{path}', ServeController::class)->where('path', '.*')
    ->middleware('throttle:15,1');

/*
|--------------------------------------------------------------------------
| Authenticated Route
|--------------------------------------------------------------------------
|
| In here you can list any route for authenticated user. These routes
| are meant to be used privately since the access is exclusive to authenticated
| user who had obtained their access through the login process.
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', HomeController::class)->name('dashboard');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/account', Profile\AccountController::class)->name('account');
        Route::resource('/setting', Profile\SettingController::class)->only(['index', 'store']);
        Route::resource('/security', Profile\SecurityController::class)->only(['index', 'store']);
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('/candidates', Candidate\CandidateController::class);
        Route::resource('/settings', Setting\SettingController::class)->only(['index', 'store', 'update']);

        Route::prefix('/voters')->name('voters.')->group(function () {
            Route::controller(Voter\VoterDataController::class)->group(function () {
                Route::post('/import', 'import')->name('import');
                Route::get('/template', 'template')->name('template');
            });

            Route::controller(Voter\VoterTokenController::class)->group(function () {
                Route::post('/{voter}/send-notification', 'sendNotification')->name('send-notification');
                Route::post('/bulk-send-notification', 'bulkSendNotification')->name('bulk-send-notification');
            });
        });

        Route::resources([
            '/admins' => Admin\AdminController::class,
            '/voters' => Voter\VoterController::class,
            '/batches' => Batch\BatchController::class,
            '/voting' => Setting\VotingController::class,
            '/sessions' => Session\SessionController::class,
            '/timelines' => Timeline\TimelineController::class,
        ], ['except' => ['create', 'show', 'edit']]);
    });
});
