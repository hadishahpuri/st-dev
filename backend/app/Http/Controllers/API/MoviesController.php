<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MoviesController extends Controller
{
    public function movie(int $room_id, int $movie_id) {
        return response()->json(
            Movie::with(['schedules'])
                ->whereDate('showtime', now()->format('Y-m-d'))
                ->where('room_id', $room_id)
                ->where('movie_id', $movie_id)
                ->first()
        );
    }
}
