<?php

namespace App\Filament\Resources\DetailTransaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Table;

class DetailTransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('transaksi.id_transaksi')
                    ->label('Transaksi'),

                Tables\Columns\TextColumn::make('layanan.nama_layanan')
                    ->label('Layanan'),

                Tables\Columns\TextColumn::make('jumlah'),

                Tables\Columns\TextColumn::make('subtotal'),

            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}