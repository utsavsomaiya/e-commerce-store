<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrUpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'decimal:2'],
            'quantity' => ['required', 'integer'], // TODO: Add max validation after find range!
            'category_ids' => [
                'required',
                'array',
                Rule::exists(Category::class, 'id'),
            ],
        ];
    }
}
