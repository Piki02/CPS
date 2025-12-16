<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Category;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip header row
        if ($row[0] === 'No' || $row[0] === 'no' || strtolower($row[2]) === 'product') {
            return null;
        }

        // Skip empty rows
        if (empty($row[2])) {
            return null;
        }

        // Map columns: No, Categories, Product, UNIT, Unit Price
        // Index:         0    1          2        3     4
        $categoryName = trim($row[1] ?? 'Uncategorized');
        $productName = trim($row[2] ?? '');
        $unit = trim($row[3] ?? 'UNIT');
        $price = $row[4] ?? 0;

        // Clean the price field by removing currency symbols, commas, and spaces
        $price = preg_replace('/[^0-9.]/', '', $price);
        
        // Convert to float
        $price = (float) $price;

        // Find or create the category
        $category = Category::firstOrCreate(['name' => $categoryName]);

        // Update existing product or create new one based on name
        return Product::updateOrCreate(
            ['name' => $productName], // Search by name
            [
                'category_id' => $category->id,
                'unit' => $unit,
                'price' => $price,
            ]
        );
    }
}
