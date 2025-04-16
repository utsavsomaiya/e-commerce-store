<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
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

    public function store(CreateOrUpdateProductRequest $request): void
    {
        DB::transaction(function () use ($request): void {
            $product = $this->productService->create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            $this->updateCategories($product, $request->get('category_ids', []));
        });
    }

    public function update(Product $product, CreateOrUpdateProductRequest $request): void
    {
        DB::transaction(function () use ($product, $request): void {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            $this->updateCategories($product, $request->get('category_ids', []));
        });
    }

    public function destroy(Product $product): void
    {
        $this->productService->delete($product);
    }

    /**
     * TODO: Needs to move in service.
     */
    private function updateCategories(Product $product, array $categoryIds): void
    {
        if (count($categoryIds) > 0) {
            $product->categories()->detach();
        }

        foreach ($categoryIds as $key => $categoryId) {
            if ($categoryId) {
                $product->categories()->attach([
                    $categoryId => [
                        'sort_order' => $key,
                    ],
                ]);
            }
        }
    }
}
