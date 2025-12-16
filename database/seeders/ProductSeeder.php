<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Office Supplies',
            'Furniture',
            'Cleaning',
        ];

        foreach ($categories as $catName) {
            $category = Category::create(['name' => $catName]);

            for ($i = 1; $i <= 5; $i++) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => "$catName Product $i",
                    'unit' => 'UNIT',
                    'price' => rand(10, 500) + 0.99,
                    'image_path' => null, // Placeholder will be used in view
                ]);
            }
        }
    }
}
