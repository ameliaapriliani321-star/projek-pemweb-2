<?php

namespace App\Filament\Resources\Layanans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_kategori')
                    ->relationship('kategori', 'nama_kategori')
                    ->required(),

                TextInput::make('nama_layanan')
                    ->required()
                    ->maxLength(50),

                TextInput::make('harga')
                    ->numeric()
                    ->required(),

                TextInput::make('satuan')
                    ->default('kg')
                    ->required(),
            ]);
    }
}