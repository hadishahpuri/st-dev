<?php

use App\Http\Controllers\API\RoomsController;
use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewsController::class, 'rooms'])->name('rooms');
Route::prefix('rooms')->group(function() {
    Route::get('/{room_id}', [ViewsController::class, 'room'])->name('room');
    Route::get('/{room_id}/movie/{movie_id}', [ViewsController::class, 'movie'])->name('roomMovie');
    Route::post('/reserve', [RoomsController::class, 'reserveSeat'])->name('reserveSeat');
});
