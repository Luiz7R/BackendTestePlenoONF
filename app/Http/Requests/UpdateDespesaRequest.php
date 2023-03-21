<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDespesaRequest extends FormRequest
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
            'descricao' => 'required_without_all:data_despesa,valor',
            'data_despesa' => 'required_without_all:descricao,valor|date|before_or_equal:today',
            'valor' => 'required_without_all:descricao,data_despesa|numeric|gte:1',
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
            'descricao.required_without_all' => 'Pelos menos um dos campos tem que ser enviado',
            'data_despesa.date_format' => 'Data da Despesa tem que estar no Formato: Dia/Mes/Ano',
            'data_despesa.before' => 'Não é possivel registrar uma despesa futura',
            'data_despesa.required_without_all' => 'Pelos menos um dos campos tem que ser enviado',
            'valor.gte' => 'Valor da Despesa deve ser positivo',
            'valor.required_without_all' => 'Pelos menos um dos campos tem que ser enviado',
        ];
    }
}
