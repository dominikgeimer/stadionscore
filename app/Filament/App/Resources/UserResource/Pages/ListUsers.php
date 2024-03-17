<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Filament\App\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Team';

    protected static ?string $breadcrumb = 'Members';

    protected ?string $heading = 'Team';

    protected ?string $subheading = 'Overview of team members';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New member')
                ->icon('heroicon-o-user-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserResource\Widgets\StatsOverview::class,
        ];
    }
}
