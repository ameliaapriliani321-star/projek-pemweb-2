<?php

namespace App\Filament\Resources\Pegawais\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PegawaiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_pegawai')
                    ->required(),

                TextInput::make('no_telepon')
                    ->tel(),

                Select::make('jabatan')
                    ->options([
                        'Admin' => 'Admin',
                        'Kasir' => 'Kasir',
                        'Owner' => 'Owner',
                    ])
                    ->required(),
            ]);
    }
}