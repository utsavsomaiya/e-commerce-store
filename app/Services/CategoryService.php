<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    public function fetchMany(): Collection
    {
        return Category::query()
            ->select('id', 'name', 'parent_category_id')
            ->with('children')
            ->get();
    }

    public function fetchWithProductCount(): Collection
    {
        return Category::query()
            ->withCount('products')
            ->orderByDesc('products_count')
            ->take(5)
            ->get();
    }

    public function delete(Category $category): void
    {
        throw_if(
            Category::query()->where('parent_category_id', $category->id)->orWhereHas('products')->exists(),
            ValidationException::withMessages([
                'error' => 'Cannot delete this category because it has associated subcategories or products.',
            ])
        );

        $category->delete();
    }
}
