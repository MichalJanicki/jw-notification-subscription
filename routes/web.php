<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\NotificationController;

Route::resource('persons', PersonController::class)->except('show');
Route::post('notifications/send', NotificationController::class)->name('notifications.send');
