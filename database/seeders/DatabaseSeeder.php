<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Utsav Somaiya',
            'email' => 'utsavsomaiya4464@gmail.com',
        ]);

        $categories = Category::factory(5)
            ->has(Category::factory(3)->has(Category::factory(2), 'categories'), 'categories')
            ->create();

        Product::factory(10)
            ->when(
                fn () => fake()->boolean(),
                fn (ProductFactory $factory) => $factory->hasAttached($categories, ['sort_order' => fake()->numberBetween(1, 10)])
            )
            ->create();
    }
}
