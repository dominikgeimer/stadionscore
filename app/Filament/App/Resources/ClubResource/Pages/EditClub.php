<?php

namespace App\Filament\App\Resources\ClubResource\Pages;

use App\Filament\App\Resources\ClubResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClub extends EditRecord
{
    protected static string $resource = ClubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
