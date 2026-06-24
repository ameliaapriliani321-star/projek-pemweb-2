<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriLayanan extends Model
{
    protected $table = 'kategori_layanan';

    protected $primaryKey = 'id_kategori';

    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'deskripsi_kategori',
    ];

    public function layanan()
    {
        return $this->hasMany(
            Layanan::class,
            'id_kategori'
        );
    }
}