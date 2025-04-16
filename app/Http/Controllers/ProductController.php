<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {}

    public function index(): Response
    {
        return Inertia::render('Products/Index', [
            'products' => $this->productService->fetchMany(),
        ]);
    }

    public function store(): void
    {
        //
    }

    public function update(Product $product): void
    {
        //
    }

    public function destroy(Product $product): void
    {
        $this->productService->delete($product);
    }
}
