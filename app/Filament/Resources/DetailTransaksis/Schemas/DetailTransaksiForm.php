<?php

namespace App\Filament\Resources\DetailTransaksis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DetailTransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('id_transaksi')
                    ->relationship('transaksi', 'id_transaksi')
                    ->required(),

                Select::make('id_layanan')
                    ->relationship('layanan', 'nama_layanan')
                    ->required(),

                TextInput::make('jumlah')
                    ->numeric()
                    ->required(),

                TextInput::make('subtotal')
                    ->numeric()
                    ->required(),
            ]);
    }
}