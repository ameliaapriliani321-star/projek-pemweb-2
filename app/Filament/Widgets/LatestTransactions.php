<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestTransactions extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Transaksi Terbaru';

    protected function getTableQuery(): Builder
    {
        return Transaksi::query()
            ->latest('id_transaksi')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [

            Tables\Columns\TextColumn::make('id_transaksi')
                ->label('ID'),

            Tables\Columns\TextColumn::make('pelanggan.nama_pelanggan')
                ->label('Pelanggan'),

            Tables\Columns\TextColumn::make('pegawai.nama_pegawai')
                ->label('Pegawai'),

            Tables\Columns\BadgeColumn::make('status_transaksi')
                ->colors([
                    'warning' => 'Proses',
                    'success' => 'Selesai',
                    'primary' => 'Diambil',
                    'danger' => 'Batal',
                ]),

            Tables\Columns\TextColumn::make('total_bayar')
                ->money('IDR'),

        ];
    }
}
