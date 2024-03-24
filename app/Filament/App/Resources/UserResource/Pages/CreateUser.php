<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Support\Enums\Alignment;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\App\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public static string | Alignment $formActionsAlignment = Alignment::Right;

    protected static ?string $title = 'Invite';

    protected ?string $heading = 'New member';

    protected static ?string $breadcrumb = 'Invite';

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->info()
            ->title($this->getRecord()->name . ' invited')
            ->body('An email has been sent with registration instructions.')
            ->sendToDatabase(User::role('admin')->get());
    }
}
