<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Discover Your Signature Scent',
                'subtitle' => 'Temukan wewangian yang mencerminkan kepribadian Anda',
                'cta_text' => 'Shop Now',
                'cta_link' => '/products',
                'image' => null, // Will use default or upload manually
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Premium Quality, Affordable Price',
                'subtitle' => 'Nikmati parfum berkualitas dengan harga terjangkau',
                'cta_text' => 'Explore Collection',
                'cta_link' => '/products',
                'image' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'New Collection 2024',
                'subtitle' => 'Koleksi terbaru dengan aroma yang lebih segar',
                'cta_text' => 'Discover Now',
                'cta_link' => '/products',
                'image' => null,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}