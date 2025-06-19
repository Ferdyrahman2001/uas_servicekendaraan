<?php

namespace App\Filament\Resources\MontirResource\Pages;

use App\Filament\Resources\MontirResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMontir extends CreateRecord
{
    protected static string $resource = MontirResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect to user list
    }

    // Optional: For more detailed notifications
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Montir created')
            ->body('The new montir has been successfully created.');
    }
}
