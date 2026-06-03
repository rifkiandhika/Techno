<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'name')->toArray();
        
        $products = [
            // Fresh Category
            [
                'code' => 'EQ-FSH-001',
                'name' => 'Ocean Breeze',
                'category' => 'Fresh',
                'description' => 'Ocean Breeze menghadirkan kesegaran samudra yang membangkitkan semangat. Perpaduan aroma sea salt, alga, dan white musk menciptakan sensasi segar yang tahan lama. Cocok untuk penggunaan sehari-hari, baik di kantor maupun saat santai.',
                'gender' => 'unisex',
                'top_notes' => 'Sea Salt, Bergamot, Lemon',
                'middle_notes' => 'Algae, Jasmine, Marine Accord',
                'base_notes' => 'White Musk, Amber, Cedarwood',
                'longevity' => 8,
                'sillage' => 7,
                'projection' => 7,
                'is_featured' => true,
                'is_best_seller' => false,
            ],
            [
                'code' => 'EQ-FSH-002',
                'name' => 'Morning Dew',
                'category' => 'Fresh',
                'description' => 'Morning Dew mengingatkan pada embun pagi yang menyegarkan. Aroma green tea, lily of the valley, dan musk putih menciptakan kesan bersih dan natural.',
                'gender' => 'female',
                'top_notes' => 'Green Tea, Bergamot, Lemon Verbena',
                'middle_notes' => 'Lily of the Valley, Jasmine, Rose',
                'base_notes' => 'White Musk, Sandalwood, Vetiver',
                'longevity' => 6,
                'sillage' => 5,
                'projection' => 5,
                'is_featured' => false,
                'is_best_seller' => true,
            ],
            
            // Woody Category
            [
                'code' => 'EQ-WDY-001',
                'name' => 'Timber Oud',
                'category' => 'Woody',
                'description' => 'Timber Oud adalah wewangian maskulin dengan dominasi aroma oud yang mewah. Dipadukan dengan sandalwood, vetiver, dan amber, menciptakan aroma hangat dan elegan yang sempurna untuk acara formal atau malam hari.',
                'gender' => 'male',
                'top_notes' => 'Saffron, Lavender, Bergamot',
                'middle_notes' => 'Oud, Cedarwood, Patchouli',
                'base_notes' => 'Sandalwood, Amber, Musk, Vanilla',
                'longevity' => 12,
                'sillage' => 9,
                'projection' => 8,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'code' => 'EQ-WDY-002',
                'name' => 'Forest Soul',
                'category' => 'Woody',
                'description' => 'Forest Soul membawa Anda ke dalam hutan pinus yang sejuk. Aroma kayu pinus, cedar, dan oakmoss menciptakan kesan alami dan maskulin.',
                'gender' => 'male',
                'top_notes' => 'Pine, Cypress, Cardamom',
                'middle_notes' => 'Cedarwood, Juniper, Clary Sage',
                'base_notes' => 'Oakmoss, Vetiver, Leather',
                'longevity' => 10,
                'sillage' => 7,
                'projection' => 7,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            
            // Floral Category
            [
                'code' => 'EQ-FLR-001',
                'name' => 'Blushing Rose',
                'category' => 'Floral',
                'description' => 'Blushing Rose adalah wewangian feminin yang romantis. Perpaduan mawar merah, peony, dan vanilla menciptakan aroma manis yang elegan. Cocok untuk kencan atau acara spesial.',
                'gender' => 'female',
                'top_notes' => 'Raspberry, Lychee, Bergamot',
                'middle_notes' => 'Rose, Peony, Magnolia',
                'base_notes' => 'Vanilla, Musk, Amber',
                'longevity' => 8,
                'sillage' => 7,
                'projection' => 7,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'code' => 'EQ-FLR-002',
                'name' => 'Jasmine Petals',
                'category' => 'Floral',
                'description' => 'Jasmine Petals menampilkan keharuman melati yang memikat. Dipadukan dengan tuberose, orange blossom, dan sandalwood untuk kesan yang lebih hangat.',
                'gender' => 'female',
                'top_notes' => 'Orange Blossom, Bergamot, Pear',
                'middle_notes' => 'Jasmine, Tuberose, Iris',
                'base_notes' => 'Sandalwood, Vanilla, Musk',
                'longevity' => 9,
                'sillage' => 7,
                'projection' => 7,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            
            // Oriental Category
            [
                'code' => 'EQ-ORN-001',
                'name' => 'Mystic Amber',
                'category' => 'Oriental',
                'description' => 'Mystic Amber adalah wewangian eksotis dengan aroma amber yang hangat dan sensual. Perpaduan vanilla, patchouli, dan benzoin menciptakan kesan misterius dan mewah.',
                'gender' => 'unisex',
                'top_notes' => 'Cinnamon, Cardamom, Orange',
                'middle_notes' => 'Amber, Patchouli, Labdanum',
                'base_notes' => 'Vanilla, Benzoin, Tonka Bean',
                'longevity' => 11,
                'sillage' => 8,
                'projection' => 8,
                'is_featured' => true,
                'is_best_seller' => false,
            ],
            
            // Citrus Category
            [
                'code' => 'EQ-CTR-001',
                'name' => 'Lemon Zest',
                'category' => 'Citrus',
                'description' => 'Lemon Zest menghadirkan kesegaran jeruk lemon yang membangkitkan semangat. Cocok untuk pagi hari atau saat berolahraga.',
                'gender' => 'unisex',
                'top_notes' => 'Lemon, Lime, Grapefruit',
                'middle_notes' => 'Neroli, Ginger, Mint',
                'base_notes' => 'Musk, Cedarwood',
                'longevity' => 5,
                'sillage' => 5,
                'projection' => 6,
                'is_featured' => false,
                'is_best_seller' => true,
            ],
            
            // Aquatic Category
            [
                'code' => 'EQ-AQT-001',
                'name' => 'Deep Blue',
                'category' => 'Aquatic',
                'description' => 'Deep Blue menghadirkan nuansa laut dalam yang misterius. Aroma sea breeze, calone, dan ambergris menciptakan kesan segar dan maskulin.',
                'gender' => 'male',
                'top_notes' => 'Sea Breeze, Calone, Grapefruit',
                'middle_notes' => 'Lavender, Rosemary, Sage',
                'base_notes' => 'Ambergris, Driftwood, Musk',
                'longevity' => 7,
                'sillage' => 7,
                'projection' => 7,
                'is_featured' => true,
                'is_best_seller' => false,
            ],
        ];

        foreach ($products as $product) {
            $categoryId = $categories[$product['category']] ?? null;
            
            if ($categoryId) {
                Product::create([
                    'code' => $product['code'],
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']) . '-' . uniqid(),
                    'category_id' => $categoryId,
                    'description' => $product['description'],
                    'gender' => $product['gender'],
                    'status' => 'active',
                    'thumbnail' => null, // Will be added manually
                    'top_notes' => $product['top_notes'],
                    'middle_notes' => $product['middle_notes'],
                    'base_notes' => $product['base_notes'],
                    'longevity' => $product['longevity'],
                    'sillage' => $product['sillage'],
                    'projection' => $product['projection'],
                    'is_featured' => $product['is_featured'],
                    'is_best_seller' => $product['is_best_seller'],
                    'views' => rand(100, 5000),
                ]);
            }
        }
    }
}