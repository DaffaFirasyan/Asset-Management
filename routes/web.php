<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Modules\Asset\Http\Controllers\AssetController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/chat', function () {
    return view('chat');
})->name('chat');
Route::resource('assets', AssetController::class);