<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string,mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|required|max:32|unique:App\Models\Category,name',
            'slug' => 'string|required|max:32|unique:App\Models\Category,slug',
            'description' => 'string|required|max:225'
        ];
    }
}
