<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Filament\App\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected ?string $heading = 'Team';

    protected ?string $subheading = 'Overview about your team members';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New member')
                ->icon('heroicon-o-user-plus'),
        ];
    }
}
