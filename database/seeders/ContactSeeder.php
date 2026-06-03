<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'whatsapp' => '6281234567890',
                'email' => 'info@equality-perfume.com',
                'instagram' => 'equalityperfume',
                'tiktok' => 'equalityperfume',
                'facebook' => 'equalityperfume',
                'address' => 'Jl. Sudirman No. 123, Jakarta Selatan, Indonesia',
            ]
        );
    }
}