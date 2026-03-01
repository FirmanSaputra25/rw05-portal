<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('events', function (Blueprint $table) {
    $table->id();
    $table->string('title'); // Judul kegiatan
    $table->text('description')->nullable(); // Deskripsi
    $table->date('date'); // Tanggal kegiatan
    $table->time('time')->nullable(); // Waktu (opsional)
    $table->string('location')->nullable(); // Lokasi
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};