<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenFoodFactsService
{
    protected $baseUrl = 'https://world.openfoodfacts.org/api/v0/product/';

    /**
     * Fetch product details by barcode.
     *
     * @param string $barcode
     * @return array|null
     */
    public function fetchProduct(string $barcode): ?array
    {
        try {
            $response = Http::get($this->baseUrl . $barcode . '.json');

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['status']) && $data['status'] == 1) {
                    $product = $data['product'];
                    return [
                        'name' => $product['product_name'] ?? null,
                        'image_url' => $product['image_url'] ?? null,
                        'barcode' => $barcode,
                    ];
                }
            }
        } catch (\Exception $e) {
            // Log error if needed
            return null;
        }

        return null;
    }
}
