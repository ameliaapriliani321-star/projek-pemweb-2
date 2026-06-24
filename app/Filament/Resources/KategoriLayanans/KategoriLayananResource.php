<?php

namespace App\Filament\Resources\KategoriLayanans;

use App\Filament\Resources\KategoriLayanans\Pages\CreateKategoriLayanan;
use App\Filament\Resources\KategoriLayanans\Pages\EditKategoriLayanan;
use App\Filament\Resources\KategoriLayanans\Pages\ListKategoriLayanans;
use App\Filament\Resources\KategoriLayanans\Pages\ViewKategoriLayanan;
use App\Filament\Resources\KategoriLayanans\Schemas\KategoriLayananForm;
use App\Filament\Resources\KategoriLayanans\Schemas\KategoriLayananInfolist;
use App\Filament\Resources\KategoriLayanans\Tables\KategoriLayanansTable;
use App\Models\KategoriLayanan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriLayananResource extends Resource
{
    protected static ?string $model = KategoriLayanan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    public static function form(Schema $schema): Schema
    {
        return KategoriLayananForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KategoriLayananInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriLayanansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKategoriLayanans::route('/'),
            'create' => CreateKategoriLayanan::route('/create'),
            'view' => ViewKategoriLayanan::route('/{record}'),
            'edit' => EditKategoriLayanan::route('/{record}/edit'),
        ];
    }
}
