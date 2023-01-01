<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {

    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string,mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'description' => 'required|string|max:2000',
            'price' => ['numeric', 'between:0,999.99'],
            'categories' => 'exists:App\Models\Category,id'
        ];
    }
}
