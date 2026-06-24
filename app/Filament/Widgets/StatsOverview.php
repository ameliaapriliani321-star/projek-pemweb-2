<?php

namespace App\Filament\Widgets;

use App\Models\Pelanggan;
use App\Models\Pegawai;
use App\Models\Layanan;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [

            Stat::make('Pelanggan', Pelanggan::count())
                ->description('Total Pelanggan')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Pegawai', Pegawai::count())
                ->description('Total Pegawai')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Layanan', Layanan::count())
                ->description('Jenis Layanan')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('warning'),

            Stat::make(
                'Pendapatan',
                'Rp ' . number_format(
                    Transaksi::where('status_transaksi', 'Selesai')
                        ->sum('total_bayar'),
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Total Pendapatan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),

            Stat::make(
                'Proses',
                Transaksi::where('status_transaksi', 'Proses')->count()
            )
                ->description('Sedang Diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make(
                'Selesai',
                Transaksi::where('status_transaksi', 'Selesai')->count()
            )
                ->description('Laundry Selesai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

        ];
    }
}