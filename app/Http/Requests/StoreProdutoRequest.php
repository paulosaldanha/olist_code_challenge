<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'quantity' => ['nullable', 'numeric'],
            'tipo_produto_id' => ['required', 'exists:tipo_produtos,id'],
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'name.max' => 'Campo nome não pode ter mais de 255 caracteres!',
            'quantity.numeric' => 'Quantidade deve ser do tipo numérico',
            'tipo_produto_id.required' => 'Tipo produto é obrigatório!'
        ];
    }
}
