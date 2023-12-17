<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:125'],
            'color' => ['required', 'string', 'max:20'],
            'image' => ['required', 'file', 'max:1024'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer',],
            'stock' => ['required', 'integer',],
            'category_id' => ['required', 'integer'],
        ];
    }
}
