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
            // 'start_date' => 'required|date_format:d/m/Y H:i:s', //TODO: Fix this (cannot validate DateTime)
            // 'end_date' => 'required|date_format:d/m/Y H:i:s|after:start_date',
            'sport_id' => 'required|exists:sports,id',
            'max_teams' => 'required|min:1|max:99999999999',
            'event_id' => 'required'
        ];
    }
}
