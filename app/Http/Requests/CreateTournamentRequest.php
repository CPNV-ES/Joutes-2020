<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:45',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'sport_id' => 'required|exists:sports,id',
            'max_teams' => 'required|min:2',
            'event_id' => 'required|exists:events,id'
        ];
    }
}
