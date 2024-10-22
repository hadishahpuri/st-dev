<?php

use App\Http\Controllers\API\RoomsController;
use Illuminate\Support\Facades\Route;

Route::prefix('rooms')->group(function() {
    Route::get('/', [RoomsController::class, 'rooms'])->name('rooms');
    Route::get('/{room_id}', [RoomsController::class, 'room'])->name('room');
    Route::get('/{room_id}/movie/{movie_id}', [RoomsController::class, 'movie'])->name('roomMovie');
});
