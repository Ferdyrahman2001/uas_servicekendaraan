<?php

namespace App\Filament\Resources\KategoriMontirResource\Pages;

use App\Filament\Resources\KategoriMontirResource;
use Filament\Actions;
use Filament\Notifications\Notification;
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect to user list
    }

    // Optional: Detailed notification
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Kategori Montir updated')
            ->body('The kategori montir details have been successfully updated.');
    }
}
