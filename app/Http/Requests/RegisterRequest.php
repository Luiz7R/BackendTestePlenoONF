<?php

namespace App\Http\Requests;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|confirmed|min:8'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome pode ser no máximo 100 caracteres',
            'email.required' => 'Email é obrigatório',
            'email.unique' => 'Email deve ser único.',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve conter pelo menos 8 caracteres',
            'password.confirmed' => 'A confirmação da senha não corresponde',
        ];
    }
}
