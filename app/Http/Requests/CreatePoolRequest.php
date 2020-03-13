<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePoolRequest extends FormRequest
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
          'poolName' => 'required|max:45',
          'start_time' => 'required',
          'end_time' => 'required',
          'stage' => 'required|numeric|min:1',
          'poolSize' => 'required|numeric|min:2',
          'mode_id' => 'required|exists:pool_modes,id',
          'game_type_id' => 'required|exists:game_types,id',
        ];
    }
}
