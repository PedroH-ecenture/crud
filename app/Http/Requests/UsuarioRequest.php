<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',

            'email' => 'required|email',

            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',

            'email.required' => 'O campo e-mail é obrigatório.',

            'email.email' => 'O email precisa ser válido.',

            'password.required' => 'A senha precisa ser válida.',

            'password.min' => 'A senha precisa ter ao menos :min caracteres.',

        ];
    }
}
