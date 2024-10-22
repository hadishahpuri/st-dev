<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Room;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoomMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        $movies = Movie::all();
        $times = ['12:00', '14:00', '16:30', '17:00'];
        $now = now();

        foreach ($rooms as $room) {
            for ($i = 0; $i < 3; $i++) {
                $movie = $movies[$i] ?? null;
                $showtime = $times[$i];
                if ($movie) {
                    Schedule::query()->create([
                        'room_id' => $room->id,
                        'movie_id' => $movie->id,
                        'showtime' => Carbon::createFromFormat('Y-m-d H:i', "{$now->year}-{$now->month}-{$now->day} {$showtime}")
                    ]);
                }
            }
        }
    }
}
