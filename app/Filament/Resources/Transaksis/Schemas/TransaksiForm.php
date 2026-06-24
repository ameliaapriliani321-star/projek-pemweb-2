<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('id_pelanggan')
                    ->relationship('pelanggan', 'nama_pelanggan')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('id_pegawai')
                    ->relationship('pegawai', 'nama_pegawai')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih pegawai'),

                DatePicker::make('tanggal_terima')
                    ->default(now())
                    ->required(),

                DatePicker::make('tanggal_selesai')
                    ->placeholder('Isi saat sudah selesai'),

                Select::make('status_transaksi')
                    ->options([
                        'Proses' => '🔄 Proses',
                        'Selesai' => '✅ Selesai',
                        'Diambil' => '📦 Diambil',
                        'Batal' => '❌ Batal',
                    ])
                    ->default('Proses')
                    ->required(),

                TextInput::make('total_bayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),
            ]);
    }
}
