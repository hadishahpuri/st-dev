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
        $movie = Movie::with(['occupiedSeats' => fn ($query) =>
                $query->whereDate('showtime', now()->format('Y-m-d'))
                    ->where('room_id', $room_id)
                    ->where('movie_id', $movie_id)
        ])->where('id', $movie_id)->first();

        $occupiedSeats = $movie->occupiedSeats->map->only('seat_number', 'row_number')->values()->toArray();
        $occupiedSeats = array_map(fn ($item) => "{$item['row_number']}_{$item['seat_number']}", $occupiedSeats);

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
