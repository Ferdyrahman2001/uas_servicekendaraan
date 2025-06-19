<?php

namespace App\Filament\Resources\MontirResource\Pages;

use App\Filament\Resources\MontirResource;
use Filament\Actions;
use Filament\Notifications\Notification;
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect to user list
    }

    // Optional: Detailed notification
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Montir updated')
            ->body('The montir details have been successfully updated.');
    }
}
