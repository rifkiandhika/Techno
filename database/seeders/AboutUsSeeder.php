<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    public function run(): void
    {
        AboutUs::updateOrCreate(
            ['id' => 1],
            [
                'brand_history' => "EQUALITY Perfume lahir pada tahun 2020 dari sebuah visi sederhana: menghadirkan wewangian berkualitas premium dengan harga yang terjangkau untuk semua kalangan masyarakat Indonesia. Kami percaya bahwa setiap orang berhak merasakan keharuman eksklusif tanpa harus mengeluarkan biaya yang berlebihan.\n\nDimulai dari sebuah usaha kecil rumahan, EQUALITY Perfume kini telah berkembang menjadi brand parfum lokal yang dikenal dengan kualitasnya. Kami menggunakan bahan-bahan terbaik dari berbagai belahan dunia, dipadukan dengan teknologi modern untuk menciptakan aroma yang tahan lama dan memikat.\n\nHingga saat ini, EQUALITY Perfume telah memiliki ratusan ribu pelanggan setia yang tersebar di seluruh Indonesia. Kami terus berinovasi untuk menciptakan wewangian-wewangian baru yang sesuai dengan tren dan preferensi masyarakat Indonesia.",
                
                'vision' => "Menjadi brand parfum lokal terkemuka yang mendunia, dikenal dengan kualitas produk terbaik dan harga yang terjangkau untuk semua lapisan masyarakat.",
                
                'mission' => "1. Menyediakan wewangian berkualitas premium dengan harga yang ramah di kantong\n2. Menggunakan bahan-bahan alami dan aman untuk kulit\n3. Terus berinovasi menciptakan aroma-aroma baru yang unik\n4. Membangun komunitas pecinta parfum yang solid di Indonesia\n5. Memberikan pelayanan terbaik kepada seluruh pelanggan",
                
                'founder_story' => "Ahmad Rizki, pendiri EQUALITY Perfume, memulai perjalanannya sebagai seorang pecinta parfum sejak remaja. Ketika kuliah, ia sering merasa frustrasi karena parfum berkualitas harganya sangat mahal, sementara parfum murah kualitasnya kurang baik.\n\nPada tahun 2019, ia memutuskan untuk belajar meracik parfum sendiri. Berbekal pengetahuan dari internet dan buku-buku, ia mulai bereksperimen di dapur rumahnya. Setelah ratusan kali percobaan, akhirnya ia berhasil menciptakan formula yang sempurna.\n\nDengan modal seadanya, ia mulai memproduksi parfum dalam jumlah kecil dan menjualnya ke teman-teman kuliah. Respons positif yang ia terima membuatnya semakin termotivasi. Kini, EQUALITY Perfume telah menjadi brand yang dikenal luas dan memiliki tim yang solid.\n\n\"Kesetaraan adalah prinsip kami. Kami ingin semua orang bisa menikmati wewangian berkualitas, tanpa memandang latar belakang ekonomi mereka,\" ujar Ahmad Rizki, Founder EQUALITY Perfume.",
                
                'founder_photo' => null,
            ]
        );
    }
}