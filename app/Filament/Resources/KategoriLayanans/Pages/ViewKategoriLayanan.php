<?php

namespace App\Filament\Resources\KategoriLayanans\Pages;

use App\Filament\Resources\KategoriLayanans\KategoriLayananResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKategoriLayanan extends ViewRecord
{
    protected static string $resource = KategoriLayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
