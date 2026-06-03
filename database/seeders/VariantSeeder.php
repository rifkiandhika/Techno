<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Variant;

class VariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        
        foreach ($products as $product) {
            // Each product has 3 variants: 30ml, 50ml, 100ml
            $basePrice = $this->getBasePriceByProduct($product->name);
            
            $variants = [
                ['size' => 30, 'price' => $basePrice, 'stock' => rand(20, 100)],
                ['size' => 50, 'price' => $basePrice * 1.5, 'stock' => rand(15, 80)],
                ['size' => 100, 'price' => $basePrice * 2.2, 'stock' => rand(10, 50)],
            ];
            
            foreach ($variants as $variant) {
                Variant::create([
                    'product_id' => $product->id,
                    'size' => $variant['size'],
                    'price' => $variant['price'],
                    'stock' => $variant['stock'],
                ]);
            }
        }
    }
    
    private function getBasePriceByProduct($productName): int
    {
        $prices = [
            'Ocean Breeze' => 120000,
            'Morning Dew' => 110000,
            'Timber Oud' => 180000,
            'Forest Soul' => 150000,
            'Blushing Rose' => 140000,
            'Jasmine Petals' => 130000,
            'Mystic Amber' => 170000,
            'Lemon Zest' => 100000,
            'Deep Blue' => 160000,
        ];
        
        return $prices[$productName] ?? 120000;
    }
}