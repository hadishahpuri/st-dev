<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function todaySchedules() {
        return $this->hasMany(Schedule::class)->whereDate('showtime', now()->format('Y-m-d'));
    }
}
