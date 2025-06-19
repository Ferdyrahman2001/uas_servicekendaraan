<?php

namespace App\Filament\Resources\LayananResource\Pages;

use App\Filament\Resources\LayananResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateLayanan extends CreateRecord
{
    protected static string $resource = LayananResource::class;

    protected function getRedirectUrl(): string
    {
        if ($this->record->status !== 'selesai') {
            return '/admin/detail-layanans/create?layanan_id=' . $this->record->id;
        }

        return $this->getResource()::getUrl('index');
    }

    // Optional: For more detailed notifications
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Layanan created')
            ->body('The new layanan has been successfully created.');
    }
}
