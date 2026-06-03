<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Cara Memilih Parfum yang Tepat untuk Pria',
                'category' => 'Tips Parfum',
                'content' => 'Memilih parfum yang tepat untuk pria tidaklah sulit jika Anda mengetahui tips dan triknya. Berikut adalah panduan lengkap untuk Anda.

1. Kenali Jenis Aroma yang Anda Sukai
Setiap orang memiliki preferensi aroma yang berbeda. Ada yang suka aroma segar (citrus, aquatic), woody (kayu-kayuan), atau oriental (rempah-rempah). Coba cari tahu dulu jenis aroma mana yang paling nyaman di hidung Anda.

2. Sesuaikan dengan Aktivitas
Untuk aktivitas sehari-hari di kantor, pilih parfum dengan aroma yang tidak terlalu menyengat seperti citrus atau aquatic. Untuk acara formal atau malam hari, Anda bisa memilih aroma woody atau oriental yang lebih maskulin.

3. Coba Sebelum Membeli
Jika memungkinkan, coba semprotkan parfum ke pergelangan tangan dan biarkan beberapa saat. Aroma parfum akan berubah seiring waktu (top notes, middle notes, base notes). Jangan langsung memutuskan dari aroma awalnya.

4. Perhatikan Ketahanan (Longevity)
Parfum dengan kualitas bagus biasanya memiliki ketahanan 6-12 jam. Perhatikan kandungan minyak parfum (extrait de parfum > parfum > eau de parfum > eau de toilette).

5. Sesuaikan dengan Budget
Parfum berkualitas tidak selalu mahal. EQUALITY Perfume menyediakan wewangian premium dengan harga terjangkau. Jangan ragu untuk mencoba!

Dengan mengikuti tips di atas, Anda pasti bisa menemukan parfum yang tepat untuk menemani setiap momen spesial Anda.',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
                'views' => rand(100, 1000),
            ],
            [
                'title' => 'Mengenal Perbedaan Top Notes, Middle Notes, dan Base Notes',
                'category' => 'Edukasi Aroma',
                'content' => 'Dalam dunia parfum, terdapat istilah top notes, middle notes (heart notes), dan base notes. Ketiga lapisan aroma ini membentuk karakter sebuah wewangian.

Apa itu Top Notes?
Top notes adalah aroma pertama yang Anda cium saat menyemprotkan parfum. Aroma ini biasanya ringan dan cepat menguap, bertahan sekitar 5-15 menit. Contoh top notes: citrus, bergamot, lemon, lavender.

Apa itu Middle Notes?
Setelah top notes menguap, middle notes atau heart notes mulai tercium. Aroma ini menjadi inti dari parfum dan bertahan lebih lama, sekitar 2-4 jam. Contoh middle notes: jasmine, rose, cinnamon, nutmeg.

Apa itu Base Notes?
Base notes adalah aroma yang bertahan paling lama, bisa sampai 8-12 jam atau lebih. Aroma ini memberikan kedalaman pada parfum. Contoh base notes: vanilla, musk, sandalwood, amber.

Mengapa Penting Memahami Ketiganya?
Memahami ketiga lapisan aroma ini akan membantu Anda memilih parfum yang tepat. Jangan hanya menilai dari top notes-nya saja, karena aroma akan berubah seiring waktu. Biarkan parfum "bekerja" minimal 30 menit di kulit Anda sebelum memutuskan apakah Anda menyukainya atau tidak.

Di EQUALITY Perfume, setiap produk kami dirancang dengan harmoni sempurna antara top, middle, dan base notes untuk memberikan pengalaman wewangian terbaik.',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
                'views' => rand(100, 1000),
            ],
            [
                'title' => 'Review: Timber Oud - The King of Woody Fragrance',
                'category' => 'Review Produk',
                'content' => 'Timber Oud dari EQUALITY Perfume menjadi salah satu produk terlaris kami. Setelah mencoba sendiri selama beberapa minggu, berikut review jujur saya.

Kemasan
Kotaknya elegan dengan warna hitam dan emas. Botolnya terbuat dari kaca dengan tutup kayu yang memberikan kesan premium.

Aroma (Top Notes)
Begitu disemprot, langsung tercium aroma saffron dan lavender yang maskulin. Ada sentuhan bergamot yang memberikan kesegaran di awal.

Aroma (Middle Notes)
Setelah 10 menit, aroma oud dan cedarwood mulai terasa kuat. Inilah jantung dari Timber Oud - aroma kayu yang hangat dan elegan.

Aroma (Base Notes)
Setelah 2 jam, vanilla, amber, dan musk mulai muncul. Kombinasi ini membuat aroma semakin hangat dan nyaman.

Ketahanan
Timber Oud sangat tahan lama! Saya mencobanya pagi hari dan aromanya masih tercium hingga malam hari (sekitar 10-12 jam). Proyeksinya juga bagus, orang di sekitar bisa mencium tapi tidak menyengat.

Kesimpulan
Timber Oud adalah pilihan sempurna untuk pria yang ingin tampil elegan dan maskulin. Cocok untuk acara formal, dinner, atau kencan malam. Dengan harga yang terjangkau, kualitas yang ditawarkan melebihi ekspektasi.

Rating: 9.5/10',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
                'views' => rand(100, 1000),
            ],
            [
                'title' => 'Tips Merawat Parfum Agar Tahan Lama',
                'category' => 'Tips Parfum',
                'content' => 'Parfum adalah investasi, baik dari segi harga maupun kenangan yang menyertainya. Agar parfum kesayangan Anda tetap awet dan kualitasnya terjaga, ikuti tips berikut:

1. Simpan di Tempat Sejuk dan Gelap
Paparan sinar matahari langsung dan suhu panas dapat merusak molekul parfum. Simpan parfum di dalam lemari atau laci yang sejuk.

2. Jauhkan dari Kamar Mandi
Kelembaban dan perubahan suhu di kamar mandi tidak baik untuk parfum. Simpan di kamar tidur atau ruangan dengan suhu stabil.

3. Tutup Rapat Setelah Digunakan
Pastikan tutup botol tertutup rapat setelah digunakan untuk mencegah oksidasi yang dapat mengubah aroma parfum.

4. Jangan Mengocok Botol
Mengocok botol parfum dapat memasukkan udara ke dalam cairan dan mempercepat oksidasi.

5. Gunakan dalam 3-5 Tahun
Meskipun parfum tidak memiliki tanggal kadaluwarsa resmi, kualitas terbaiknya biasanya bertahan 3-5 tahun setelah dibuka.

Dengan perawatan yang tepat, parfum kesayangan Anda akan tetap wangi dan awet lebih lama!',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
                'views' => rand(100, 1000),
            ],
            [
                'title' => 'Parfum untuk Pria: Rekomendasi Berdasarkan Kepribadian',
                'category' => 'Tips Parfum',
                'content' => 'Memilih parfum sebenarnya bisa disesuaikan dengan kepribadian Anda. Berikut rekomendasi dari EQUALITY Perfume:

1. The Confident Man (Percaya Diri)
Jika Anda adalah pria yang percaya diri dan tidak takut tampil beda, pilih aroma woody atau oriental yang berani. Rekomendasi: Timber Oud - aroma oud yang kuat dan elegan.

2. The Gentle Man (Lembut)
Pria yang lembut dan romantis cocok dengan aroma floral atau fresh yang tidak terlalu menyengat. Rekomendasi: Morning Dew - aroma segar dan menenangkan.

3. The Active Man (Aktif)
Untuk pria yang aktif dan energik, pilih aroma citrus atau aquatic yang segar. Rekomendasi: Ocean Breeze atau Lemon Zest.

4. The Classic Man (Klasik)
Pria klasik yang elegan cocok dengan aroma woody atau aromatic. Rekomendasi: Forest Soul - aroma kayu pinus yang maskulin.

5. The Mysterious Man (Misterius)
Untuk pria misterius dan penuh teka-teki, pilih aroma oriental atau amber. Rekomendasi: Mystic Amber - aroma hangat dan sensual.

Yang terpenting, pilihlah parfum yang membuat Anda merasa nyaman dan percaya diri. Karena wewangian terbaik adalah yang mencerminkan diri Anda sendiri.',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
                'views' => rand(100, 1000),
            ],
            [
                'title' => 'The Art of Layering Parfum: Cara Kombinasi Aroma',
                'category' => 'Edukasi Aroma',
                'content' => 'Layering parfum adalah teknik menggabungkan beberapa wewangian untuk menciptakan aroma unik yang mencerminkan kepribadian Anda. Berikut panduan singkatnya:

Apa itu Layering?
Layering adalah teknik menggunakan lebih dari satu produk wewangian (bisa parfum dengan body lotion, atau dua parfum berbeda) untuk menciptakan aroma yang lebih kompleks dan personal.

Tips Layering untuk Pemula:

1. Mulai dengan Aroma Netral
Gunakan body lotion atau base scent yang netral sebagai fondasi.

2. Pilih Aroma yang Satu Keluarga
Jangan mencampur aroma yang terlalu kontras. Misalnya, citrus dengan floral masih aman, tapi citrus dengan oud mungkin terlalu berisiko.

3. Spray dari Jarak Jauh
Semprotkan parfum dari jarak 15-20 cm agar tidak terlalu pekat.

4. Jangan Berlebihan
Cukup 2-3 semprotan total. Parfum yang berlebihan bisa membuat pusing orang di sekitar.

Rekomendasi Kombinasi dari EQUALITY:
- Ocean Breeze + Lemon Zest = Double freshness yang menyegarkan
- Timber Oud + Mystic Amber = Aroma hangat dan elegan untuk malam hari
- Blushing Rose + Lemon Zest = Manis segar untuk sehari-hari

Eksperimenlah dan temukan kombinasi favorit Anda sendiri!',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
                'views' => rand(100, 1000),
            ],
        ];

        foreach ($articles as $article) {
            Article::create([
                'title' => $article['title'],
                'slug' => Str::slug($article['title']) . '-' . uniqid(),
                'category' => $article['category'],
                'content' => $article['content'],
                'featured_image' => $article['featured_image'],
                'is_published' => $article['is_published'],
                'published_at' => $article['published_at'],
                'views' => $article['views'],
            ]);
        }
    }
}