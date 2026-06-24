<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'ms_layanan';

    protected $primaryKey = 'id_layanan';

    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'nama_layanan',
        'harga',
        'satuan',
    ];

    public function kategori()
    {
        return $this->belongsTo(
            KategoriLayanan::class,
            'id_kategori'
        );
    }

    public function detailTransaksi()
{
    return $this->hasMany(
        DetailTransaksi::class,
        'id_layanan'
    );
}
}