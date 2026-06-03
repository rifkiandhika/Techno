<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            CategorySeeder::class,
            ContactSeeder::class,
            AboutUsSeeder::class,
            BannerSeeder::class,
            ProductSeeder::class,
            VariantSeeder::class,
            TestimonialSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}