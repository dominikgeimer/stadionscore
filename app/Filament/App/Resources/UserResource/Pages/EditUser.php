<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Support\Enums\Alignment;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\App\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public static string | Alignment $formActionsAlignment = Alignment::Right;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(fn ($record) =>
                    Notification::make()
                        ->success()
                        ->title($record->name . ' deleted')
                        ->body('The user has been deleted successfully.'),
                ),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User updated')
            ->body('Changes have been saved successfully.');
    }
}
