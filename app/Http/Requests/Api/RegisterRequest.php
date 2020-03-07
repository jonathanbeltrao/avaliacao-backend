<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',

            'name.min' => 'O campo nome precisa ter ao menos 2 caracteres',

            'email' => 'Por favor digite um email válido',
            'email.unique' => 'Este email já existe',

            'password.min' => 'O campo precisa ter ao menos 8 caracteres',
            'password.confirmed' => 'Os valores de Senha precisam ser iguais',
        ];
    }
}
