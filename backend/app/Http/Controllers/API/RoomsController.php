<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomsController extends Controller
{
    public function rooms() {
        return response()->json(Room::all());
    }

    public function room(int $id) {
        return response()->json(Room::with(['todayMovies'])->find($id));
    }
}
