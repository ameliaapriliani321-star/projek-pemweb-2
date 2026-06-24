<?php

namespace App\Filament\Resources\KategoriLayanans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KategoriLayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(100),

                Textarea::make('deskripsi_kategori')
                    ->label('Deskripsi')
                    ->rows(4),
            ]);
    }
}