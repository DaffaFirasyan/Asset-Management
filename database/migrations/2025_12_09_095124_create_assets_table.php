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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Nama Barang (Laptop, Proyektor)
            $table->string('serial_number')->unique(); // Nomor Seri Unik
            $table->string('location');         // Lokasi (Lantai 1, Gudang)
            // Status penting untuk Logic AI nanti
            $table->enum('status', ['available', 'in_use', 'broken', 'maintenance'])->default('available');
            $table->text('description')->nullable(); // Deskripsi tambahan (warna, spek)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
