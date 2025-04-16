<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function fetchMany(): Collection
    {
        return Product::query()
            ->select('id', 'name', 'price')
            ->with('categories:id,name')
            ->get(); // TODO: use `->paginate();`
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
