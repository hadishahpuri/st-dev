<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

    public function occupiedSeats() {
        return $this->hasMany(UserSeat::class, 'movie_id');
    }

    public function getOccupiedSeats(int $room_id) {
        $occupiedSeats = $this->occupiedSeats()
            ->whereDate('showtime', now()->format('Y-m-d'))
            ->where('room_id', $room_id)
            ->where('movie_id', $this->id)
            ->get();

        $occupiedSeats = $occupiedSeats->map->only('seat_number', 'row_number')->values()->toArray();
        return !empty($occupiedSeats) ? array_map(fn ($item) => "{$item['row_number']}_{$item['seat_number']}", $occupiedSeats) : [];
    }
}
