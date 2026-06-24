<?php

namespace App\Filament\Resources\Pembayarans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('id_transaksi')
                    ->relationship('transaksi', 'id_transaksi')
                    ->required(),

                DateTimePicker::make('tanggal_bayar'),

                TextInput::make('jumlah_bayar')
                    ->numeric()
                    ->required(),

                Select::make('metode_pembayaran')
                    ->options([
                        'Tunai' => 'Tunai',
                        'Transfer' => 'Transfer',
                        'QRIS' => 'QRIS',
                    ]),
            ]);
    }
}