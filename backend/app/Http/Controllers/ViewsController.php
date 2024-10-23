<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Inertia\Inertia;

class ViewsController extends Controller
{
    public function rooms() {
        return Inertia::render('Rooms', [
            'rooms' => Room::all()
        ]);
    }
}
