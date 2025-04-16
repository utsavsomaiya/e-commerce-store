<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard', [
            'categoryDistributions' => app(CategoryService::class)
                ->fetchWithProductCount()
                ->map(fn (Category $category): array => [
                    'category' => $category->name,
                    'count' => $category->products_count,
                ]),
        ]);
    }
}
