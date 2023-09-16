<?php

use App\Http\Controllers\Auth\InvitationController;
use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [InvitationController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [InvitationController::class, 'savePassword']);
});
