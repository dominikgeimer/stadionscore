<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Filament\App\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Alignment;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public static string|Alignment $formActionsAlignment = Alignment::Right;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(fn ($record) => Notification::make()
                    ->success()
                    ->title($record->name.' deleted')
                    ->body('The user has been deleted successfully.')
                    ->sendToDatabase(User::role('admin')->get()),
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
            ->info()
            ->title($this->getRecord()->name.' updated')
            ->body('Changes have been saved successfully.')
            ->sendToDatabase(User::role('admin')->get());
    }
}
