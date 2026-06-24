<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->unsignedInteger('id_transaksi')->nullable();
            $table->unsignedInteger('id_layanan')->nullable();
            $table->decimal('jumlah', 10, 2);
            $table->decimal('subtotal', 10, 2);

            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('ms_layanan')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
