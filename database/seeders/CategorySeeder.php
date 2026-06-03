<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fresh',
                'description' => 'Aroma segar dan ringan, cocok untuk penggunaan sehari-hari. Memberikan kesan bersih dan energik.',
                'image' => null,
            ],
            [
                'name' => 'Woody',
                'description' => 'Aroma kayu-kayuan yang hangat dan elegan. Memberikan kesan maskulin dan dewasa.',
                'image' => null,
            ],
            [
                'name' => 'Floral',
                'description' => 'Aroma bunga-bunga yang manis dan feminin. Memberikan kesan romantis dan anggun.',
                'image' => null,
            ],
            [
                'name' => 'Oriental',
                'description' => 'Aroma eksotis dengan sentuhan rempah dan amber. Memberikan kesan misterius dan mewah.',
                'image' => null,
            ],
            [
                'name' => 'Citrus',
                'description' => 'Aroma jeruk-jerukan yang segar dan ceria. Memberikan kesan ceria dan penuh energi.',
                'image' => null,
            ],
            [
                'name' => 'Aquatic',
                'description' => 'Aroma segar seperti air laut dan ocehan. Memberikan kesan bersih dan menenangkan.',
                'image' => null,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'image' => $category['image'],
            ]);
        }
    }
}