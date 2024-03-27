<?php

namespace App\Filament\App\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Members', User::count()),
            Stat::make('Active', User::whereNull('invitation_valid_until')->count()),
            Stat::make('Pending', User::whereNotNull('invitation_valid_until')->count()),
        ];
    }
}
