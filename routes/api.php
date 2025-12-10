<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ChatBot\Http\Controllers\ChatController;

Route::prefix('v1')->group(function () {
    
    Route::post('/chat', [ChatController::class, 'send']);
    
});