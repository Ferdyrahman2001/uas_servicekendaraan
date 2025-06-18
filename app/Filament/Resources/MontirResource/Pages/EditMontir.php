<?php

namespace App\Filament\Resources\MontirResource\Pages;

use App\Filament\Resources\MontirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMontir extends EditRecord
{
    protected static string $resource = MontirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
