<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'slug' => 'required|min:2|max:5|unique:roles,slug',
            'name' => 'required|max:45|unique:roles,name'
        ];
    
    }

    public function messages()
    {
        return [
            'slug.required' => 'Veuillez entrer un slug',
            'slug.min' => 'Le slug est trop petit, 2 à 5 caractères max',
            'slug.max' => 'Le slug est trop grand, 2 à 5 caractères max',
            'slug.unique' => 'Ce slug existe déjà',
            'name.required' => 'Veuillez entrer un nom',
            'name.max' => 'Le nom est trop long, 45 caractères max',
            'name.unique' => 'Ce nom existe déjà'
        ];
    }
}
    