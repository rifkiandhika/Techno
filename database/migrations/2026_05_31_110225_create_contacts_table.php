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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('facebook')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
        
        // Insert default contact
        DB::table('contacts')->insert([
            'whatsapp' => '628123456789',
            'email' => 'info@equality-perfume.com',
            'instagram' => 'equalityperfume',
            'tiktok' => 'equalityperfume',
            'facebook' => 'equalityperfume',
            'address' => 'Jakarta, Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
