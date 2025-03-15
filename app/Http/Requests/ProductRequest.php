<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change to `false` if authorization is required
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];

        // For update, make fields optional
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            foreach ($rules as $field => $rule) {
                $rules[$field] = str_replace('required|', '', $rule); // Remove 'required'
            }
        }

        return $rules;
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'stock.required' => 'Stock quantity is required.',
            'stock.integer' => 'Stock must be an integer.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
        ];
    }
}
