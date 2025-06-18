<?php

namespace App\Filament\Resources\KategoriMontirResource\Pages;

use App\Filament\Resources\KategoriMontirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriMontir extends EditRecord
{
    protected static string $resource = KategoriMontirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
