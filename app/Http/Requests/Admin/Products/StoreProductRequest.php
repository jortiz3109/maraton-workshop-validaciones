<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'size:10', 'alpha_num'],
            'name' => ['required', 'min:5', 'max:100'],
            'price' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'min:10', 'max:250'],
        ];
    }

    /**
     * OPCIONAL PARA PERSONALIZAR LOS TEXTOS DE ERROR
     *
    public function messages(): array
    {
        return [
            'name.required' => 'Venga!! el :attribute es necesario para esta operación',
            'min' => 'No seas así!!!! dame un valor mínimo para este campo :attribute de :min'
        ];
    }
     *
     */

    /**
     * OPCIONAL PARA PERSONALIZAR LOS NOMBRES DE LOS ATRIBUTOS
     *
    public function attributes(): array
    {
        return [
            'name' => 'Nombre del producto'
        ];
    }
     *
     */
}
