<?php

namespace App\Filament\Resources\Layanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class LayanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_layanan')
                    ->label('ID'),

                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori'),

                Tables\Columns\TextColumn::make('nama_layanan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('satuan'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}