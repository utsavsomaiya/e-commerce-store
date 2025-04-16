<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrUpdateCategoryRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Category::class)
                    ->ignore($this->route()->parameter('category')),
            ],
            'parent_category_id' => [
                'nullable',
                'integer',
                Rule::exists(Category::class, 'id'),
            ],
        ];
    }
}
