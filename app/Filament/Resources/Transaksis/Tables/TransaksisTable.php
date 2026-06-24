<?php

namespace App\Filament\Resources\Transaksis\Tables;

use App\Models\Transaksi;
use App\Models\Pembayaran;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_transaksi')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('pelanggan.nama_pelanggan')
                    ->label('Pelanggan')
                    ->searchable(),

                TextColumn::make('pegawai.nama_pegawai')
                    ->label('Pegawai')
                    ->placeholder('Belum diassign')
                    ->searchable(),

                TextColumn::make('tanggal_terima')
                    ->label('Tgl Terima')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_selesai')
                    ->label('Tgl Selesai')
                    ->date('d M Y')
                    ->placeholder('—'),

                TextColumn::make('status_transaksi')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Proses' => 'warning',
                        'Selesai' => 'success',
                        'Diambil' => 'info',
                        'Batal' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('total_bayar')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('pembayaran_status')
                    ->label('Bayar')
                    ->badge()
                    ->getStateUsing(fn (Transaksi $record): string => $record->pembayaran->isNotEmpty() ? 'Lunas' : 'Belum')
                    ->color(fn (string $state): string => $state === 'Lunas' ? 'success' : 'warning'),
            ])
            ->defaultSort('id_transaksi', 'desc')
            ->filters([
                SelectFilter::make('status_transaksi')
                    ->label('Status')
                    ->options([
                        'Proses' => 'Proses',
                        'Selesai' => 'Selesai',
                        'Diambil' => 'Diambil',
                        'Batal' => 'Batal',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                Action::make('bayar')
                    ->label('Bayar')
                    ->icon('heroicon-m-banknotes')
                    ->color('success')
                    ->modalHeading('Proses Pembayaran')
                    ->modalDescription(fn (Transaksi $record): string => "Transaksi #{$record->id_transaksi} — Total: Rp " . number_format($record->total_bayar, 0, ',', '.'))
                    ->form([
                        TextInput::make('jumlah_bayar')
                            ->label('Jumlah Bayar')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->default(fn (Transaksi $record): int => $record->total_bayar),

                        Select::make('metode_pembayaran')
                            ->label('Metode Pembayaran')
                            ->options([
                                'Tunai' => 'Tunai',
                                'Transfer' => 'Transfer',
                                'QRIS' => 'QRIS',
                            ])
                            ->required()
                            ->default('Tunai'),

                        DatePicker::make('tanggal_bayar')
                            ->label('Tanggal Bayar')
                            ->required()
                            ->default(now()),
                    ])
                    ->visible(fn (Transaksi $record): bool => $record->pembayaran->isEmpty() && $record->status_transaksi !== 'Batal')
                    ->action(function (Transaksi $record, array $data): void {
                        Pembayaran::create([
                            'id_transaksi' => $record->id_transaksi,
                            'tanggal_bayar' => $data['tanggal_bayar'],
                            'jumlah_bayar' => $data['jumlah_bayar'],
                            'metode_pembayaran' => $data['metode_pembayaran'],
                        ]);
                    }),

                Action::make('selesai')
                    ->label('Selesai')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Selesai?')
                    ->modalDescription('Pesanan ini akan ditandai sebagai selesai dikerjakan.')
                    ->visible(fn (Transaksi $record): bool => $record->status_transaksi === 'Proses')
                    ->action(function (Transaksi $record): void {
                        $record->update([
                            'status_transaksi' => 'Selesai',
                            'tanggal_selesai' => now()->toDateString(),
                        ]);
                    }),

                Action::make('diambil')
                    ->label('Diambil')
                    ->icon('heroicon-m-truck')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Diambil?')
                    ->modalDescription('Pesanan ini akan ditandai sudah diambil oleh pelanggan.')
                    ->visible(fn (Transaksi $record): bool => $record->status_transaksi === 'Selesai')
                    ->action(function (Transaksi $record): void {
                        $record->update([
                            'status_transaksi' => 'Diambil',
                        ]);
                    }),

                Action::make('batal')
                    ->label('Batal')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Pesanan?')
                    ->modalDescription('Pesanan ini akan dibatalkan. Tindakan ini tidak bisa di-undo.')
                    ->visible(fn (Transaksi $record): bool => $record->status_transaksi === 'Proses')
                    ->action(function (Transaksi $record): void {
                        $record->update([
                            'status_transaksi' => 'Batal',
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
