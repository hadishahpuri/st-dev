<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function todayMovies() {
        return $this->hasManyThrough(Movie::class, Schedule::class)->whereDate('showtime', now()->format('Y-m-d'));
    }
}
