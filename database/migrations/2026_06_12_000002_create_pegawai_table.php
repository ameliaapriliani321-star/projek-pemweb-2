<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->string('nama_pegawai', 100);
            $table->string('no_telepon', 20)->nullable();
            $table->enum('jabatan', ['Admin', 'Kasir', 'Owner'])->default('Kasir');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
