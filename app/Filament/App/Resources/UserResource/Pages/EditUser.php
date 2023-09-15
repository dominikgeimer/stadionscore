<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\Alignment;
use Filament\Resources\Pages\EditRecord;
use App\Filament\App\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public static string | Alignment $formActionsAlignment = Alignment::Right;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
