<?php

namespace App\Filament\Resources\KategoriMontirResource\Pages;

use App\Filament\Resources\KategoriMontirResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriMontir extends CreateRecord
{
    protected static string $resource = KategoriMontirResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect to user list
    }

    // Optional: For more detailed notifications
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Kategori Montir created')
            ->body('The new kategori montir has been successfully created.');
    }
}
