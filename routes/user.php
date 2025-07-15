<?php

use App\Http\Controllers\UserInviteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Fetch user invites
    Route::get('/user/invites', [UserInviteController::class, 'index']);
});
