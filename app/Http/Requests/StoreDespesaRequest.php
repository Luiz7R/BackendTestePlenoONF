<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDespesaRequest extends FormRequest
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
            'descricao' => 'required|max:191',
            'data_despesa' => 'required|date|before_or_equal:today',
            'valor' => 'required|numeric|gte:1'
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
            'descricao' => 'a Descrição não pode ser maior que 191 caracteres',
            'descricao.required_without_all' => 'Pelos menos um dos campos tem que ser enviado',
            'data_despesa.before_or_equal' => 'Não é possivel registrar uma despesa futura',
            'data_despesa.required_without_all' => 'Pelos menos um dos campos tem que ser enviado',
            'valor.gte' => 'Valor da Despesa deve ser positivo',
            'valor.required_without_all' => 'Pelos menos um dos campos tem que ser enviado',
        ];
    }
}
