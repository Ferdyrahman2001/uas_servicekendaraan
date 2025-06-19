<?php

namespace App\Filament\Resources\LayananResource\Pages;

use App\Filament\Resources\LayananResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditLayanan extends EditRecord
{
    protected static string $resource = LayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Optional: For more detailed notifications
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Layanan updated')
            ->body('The layanan has been successfully updated.');
    }
}
