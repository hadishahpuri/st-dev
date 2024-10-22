<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 4; $i++) {
            Room::query()->create([
                'name' => "room_$i",
                'rows_number' => 10,
                'seats_number' => 8
            ]);
        }
    }
}
