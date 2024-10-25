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
}
