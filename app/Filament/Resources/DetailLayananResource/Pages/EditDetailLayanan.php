<?php

namespace App\Filament\Resources\DetailLayananResource\Pages;

use App\Filament\Resources\DetailLayananResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditDetailLayanan extends EditRecord
{
    protected static string $resource = DetailLayananResource::class;

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
            ->title('Detail Layanan updated')
            ->body('The detail layanan details have been successfully updated.');
    }
}
