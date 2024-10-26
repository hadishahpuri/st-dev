<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Room;
use App\Models\Schedule;
use Inertia\Inertia;

class ViewsController extends Controller
{
    public function rooms() {
        return Inertia::render('Rooms', [
            'rooms' => Room::all()
        ]);
    }

    public function room(int $room_id) {
        return Inertia::render('Room', [
            'room' => Room::with(['todaySchedules', 'todaySchedules.movie'])->find($room_id)
        ]);
    }

    public function movie(int $room_id, int $movie_id) {
        $movie = Movie::query()->where('id', $movie_id)->first();
        $occupiedSeats = $movie->getOccupiedSeats($room_id);

        $schedule = Schedule::with('room')
            ->where('room_id', $room_id)
            ->where('movie_id', $movie_id)
            ->whereDate('showtime', now()->format('Y-m-d'))
            ->first();

        return Inertia::render('Movie', [
            'movie' => $movie,
            'schedule' => $schedule,
            'occupiedSeats' => $occupiedSeats
        ]);
    }
}
