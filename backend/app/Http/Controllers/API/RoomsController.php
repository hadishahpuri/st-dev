<?php

namespace App\Http\Controllers\API;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequests\ReserveSeatRequest;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserSeat;

class RoomsController extends Controller
{
    public function reserveSeat(ReserveSeatRequest $request) {
        $schedule = Schedule::query()->find($request->get('schedule_id'));
        $validatedSeats = $this->validateSeatSelection($schedule, $request->get('selectedSeats'));
        $testUser = User::query()->find(1);
        $userSeats = [];
        foreach ($validatedSeats as $seat) {
            $userSeats[] = [
                'user_id' => $testUser->id,
                'room_id' => $schedule->room_id,
                'movie_id' => $schedule->movie_id,
                'showtime' => $schedule->showtime,
                'row_number' => $seat['row'],
                'seat_number' => $seat['seat'],
            ];
        }

        UserSeat::query()->insert($userSeats);

        $movie = Movie::query()->find($schedule->movie_id);
        $occupiedSeats = $movie->getOccupiedSeats($schedule->room_id);

        return response()->json(['occupiedSeats' => $occupiedSeats]);
    }

    private function validateSeatSelection(Schedule $schedule, array $selected_seats): array {
        $validatedSeats = [];
        foreach ($selected_seats as $item) {
            [$row, $seat] = explode('_', $item);
            if ($row > $schedule->room->rows_number || $seat > $schedule->room->seats_number) {
                throw new ApiException('Invalid row or seat number!', 422);
            }

            $alreadyOccupied = UserSeat::query()
                ->where('room_id', $schedule->room_id)
                ->where('movie_id', $schedule->movie_id)
                ->where('showtime', $schedule->showtime)
                ->where('row_number', $row)
                ->where('seat_number', $seat)
                ->exists();
            if ($alreadyOccupied) {
                throw new ApiException('Some of the seats you selected are already occupied! Please refresh the page and try again.', 422);
            }

            $validatedSeats[] = ['row' => $row, 'seat' => $seat];
        }

        return $validatedSeats;
    }
}
