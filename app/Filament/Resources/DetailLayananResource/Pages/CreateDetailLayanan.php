<?php

namespace App\Filament\Resources\DetailLayananResource\Pages;

use App\Filament\Resources\DetailLayananResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateDetailLayanan extends CreateRecord
{
    protected static string $resource = DetailLayananResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect to user list
    }

    // Optional: For more detailed notifications
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Detail Layanan created')
            ->body('The new detail layanan has been successfully created.');
    }
}
