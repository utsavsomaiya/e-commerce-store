<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateCategoryRequest;
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

    public function store(CreateOrUpdateCategoryRequest $request): void
    {
        $this->categoryService->create($request->all());
    }

    public function update(Category $category, CreateOrUpdateCategoryRequest $request): void
    {
        $this->categoryService->update($category, $request->all());
    }

    public function destroy(Category $category): void
    {
        $this->categoryService->delete($category);
    }
}
