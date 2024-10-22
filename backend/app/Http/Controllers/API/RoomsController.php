<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequests\ReserveSeatRequest;
use App\Models\Movie;
use App\Models\Room;
use App\Models\User;
use App\Models\UserSeat;

class RoomsController extends Controller
{
    public function rooms() {
        return response()->json(Room::all());
    }

    public function room(int $room_id) {
        return response()->json(Room::with(['todaySchedules', 'todaySchedules.movie'])->find($room_id));
    }

    public function movie(int $room_id, int $movie_id) {
        return response()->json(
            Movie::with(['filledSeats' => fn ($query) =>
                $query->select('room_id', 'movie_id', 'showtime', 'row_number', 'seat_number')
                    ->whereDate('showtime', now()->format('Y-m-d'))
                    ->where('room_id', $room_id)
                    ->where('movie_id', $movie_id)])
                ->first()
        );
    }

    public function reserveSeat(ReserveSeatRequest $request) {
        return response()->json(UserSeat::query()->create([
            'user_id' => User::query()->find(1)->id,
            'room_id' => $request->get('room_id'),
            'movie_id' => $request->get('movie_id'),
            'showtime' => $request->get('showtime'),
            'row_number' => $request->get('row_number'),
            'seat_number' => $request->get('seat_number'),
        ]));
    }
}
