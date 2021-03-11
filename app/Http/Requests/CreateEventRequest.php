<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|min:10|max:255|unique:events,name',
            'img' => 'required|min:5|max:45',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Veuillez entrer un nom',
            'name.min' => 'Le nom est trop petit, 10 caractères min',
            'name.max' => 'Le nom est trop grand, 255 caractères max',
            'name.unique' => 'Ce nom existe déjà',
            'img.required' => 'Veuillez entrer une image',
            'img.max' => 'L\'image n\'est pas conforme ',
        ];
    }
}