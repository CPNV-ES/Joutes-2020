<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRoleRequest extends FormRequest
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
            'name' => 'required|max:45|unique:roles,name,ignore($role->name)'
        ];
    
    }

    public function messages()
    {
        return [
            'name.required' => 'Veuillez entrer un nom',
            'name.max' => 'Le nom est trop long, 45 caractères max',
            'name.unique' => 'Ce nom existe déjà'
        ];
    }
}
