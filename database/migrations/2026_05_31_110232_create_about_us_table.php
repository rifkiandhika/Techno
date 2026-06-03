<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->text('brand_history')->nullable();
            $table->string('vision')->nullable();
            $table->string('mission')->nullable();
            $table->text('founder_story')->nullable();
            $table->string('founder_photo')->nullable();
            $table->timestamps();
        });
        
        DB::table('about_us')->insert([
            'brand_history' => 'Equality Perfume adalah brand parfum yang didirikan...',
            'vision' => 'Menjadi brand parfum terkemuka yang menyediakan wewangian berkualitas untuk semua kalangan.',
            'mission' => 'Menyediakan parfum berkualitas dengan harga terjangkau',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
