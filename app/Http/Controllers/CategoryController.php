<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService,
    ) {}

    public function index(): Response
    {
        return Inertia::render('Categories/Index', [
            'categories' => $this->categoryService->fetchMany(),
        ]);
    }

    public function store(): void
    {
        //
    }

    public function update(Category $category): void
    {
        //
    }

    public function destroy(Category $category): void
    {
        $this->categoryService->delete($category);
    }
}
