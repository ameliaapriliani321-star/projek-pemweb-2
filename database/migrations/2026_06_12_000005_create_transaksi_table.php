<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->unsignedInteger('id_pelanggan')->nullable();
            $table->unsignedInteger('id_pegawai')->nullable();
            $table->dateTime('tanggal_terima')->useCurrent();
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status_transaksi', ['Proses', 'Selesai', 'Diambil', 'Batal'])->default('Proses');
            $table->decimal('total_bayar', 10, 2)->default(0);

            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('set null');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
