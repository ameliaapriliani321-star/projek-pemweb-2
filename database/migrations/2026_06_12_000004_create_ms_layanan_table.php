<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_layanan', function (Blueprint $table) {
            $table->increments('id_layanan');
            $table->unsignedInteger('id_kategori')->nullable();
            $table->string('nama_layanan', 50);
            $table->decimal('harga', 10, 2);
            $table->string('satuan', 20)->default('kg');

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_layanan')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_layanan');
    }
};
