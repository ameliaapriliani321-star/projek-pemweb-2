<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    public $timestamps = false;

    protected $fillable = [
        'nama_pegawai',
        'no_telepon',
        'jabatan',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pegawai');
    }
}