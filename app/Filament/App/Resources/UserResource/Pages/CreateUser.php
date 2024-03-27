<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Filament\App\Resources\UserResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Alignment;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public static string|Alignment $formActionsAlignment = Alignment::Right;

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
            ->title($this->getRecord()->name.' invited')
            ->body('An email has been sent with registration instructions.')
            ->sendToDatabase(User::role('admin')->get());
    }
}
