<?php

namespace App\Http\Requests\MovieRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReserveSeatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * get the validation rules that apply to the request.
     *
     * @return array<string, \illuminate\contracts\validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'movie_id' => 'required|exists:movies,id',
            'row_number' => 'required|number|min:1',
            'showtime' => ['required', rule::exists('schedules', 'showtime')
                ->where('room_id', $this->get('room_id'))
                ->where('movie_id', $this->get('movie_id'))
                , Rule::unique('user_seats', 'showtime')
                    ->where('room_id', $this->get('room_id'))
                    ->where('movie_id', $this->get('movie_id'))
            ],
        ];
    }
}
