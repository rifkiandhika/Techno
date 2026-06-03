<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Sarah Wijaya',
                'review' => 'Aku suka banget sama Ocean Breeze! Aromanya segar dan tahan lama seharian. Udah beli 2 kali dan pasti bakal repeat order lagi. Recommended banget!',
                'rating' => 5,
                'is_active' => true,
                'photo' => null,
            ],
            [
                'name' => 'Budi Santoso',
                'review' => 'Timber Oud benar-benar luar biasa! Aromanya maskulin dan elegan. Banyak teman yang nanya pakai parfum apa. Harga terjangkau dengan kualitas premium.',
                'rating' => 5,
                'is_active' => true,
                'photo' => null,
            ],
            [
                'name' => 'Diana Putri',
                'review' => 'Blushing Rose wanginya manis banget! Cocok buat sehari-hari atau acara formal. Pengirimannya cepat dan packingnya rapi. Thanks Equality!',
                'rating' => 5,
                'is_active' => true,
                'photo' => null,
            ],
            [
                'name' => 'Rizki Fadillah',
                'review' => 'Mystic Amber wanginya unik banget, beda dari yang lain. Long lasting, bisa sampai 10 jam. Worth it banget untuk harganya.',
                'rating' => 4,
                'is_active' => true,
                'photo' => null,
            ],
            [
                'name' => 'Andi Nugroho',
                'review' => 'Deep Blue cocok banget buat yang suka aroma laut. Segar dan nggak norak. Pelayanan customer service juga responsif. Top markotop!',
                'rating' => 5,
                'is_active' => true,
                'photo' => null,
            ],
            [
                'name' => 'Rina Kurniawati',
                'review' => 'Lemon Zest wanginya bikin semangat pagi. Segar banget! Cocok buat yang aktif. Harga juga bersahabat.',
                'rating' => 4,
                'is_active' => true,
                'photo' => null,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}