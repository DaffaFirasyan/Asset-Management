<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Asset\Http\Controllers\ChatController;

Route::prefix('v1')->group(function () {
    
    Route::post('/chat', [ChatController::class, 'send']);
    
});