<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\Game;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Forms\Components\BelongsToManyMultiSelect;
use App\Filament\App\Resources\GameResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\GameResource\RelationManagers;
use App\Filament\App\Resources\GameResource\RelationManagers\UsersRelationManager;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'phosphor-soccer-ball-duotone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('matchday')
                ->options([
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                ]),
                DatePicker::make('date')
                    ->required(),
                Select::make('home_club_id')
                    ->relationship(name: 'homeClub', titleAttribute: 'name')
                    ->required(),
                Select::make('away_club_id')
                    ->relationship(name: 'awayClub', titleAttribute: 'name')
                    ->required(),
                TextInput::make('result'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('matchday')
                    ->badge()
                    ->sortable(),
                TextColumn::make('date'),
                ImageColumn::make('homeClub.logo_url')
                    ->label(false),
                TextColumn::make('homeClub.name')
                    ->label('Home'),
                TextColumn::make('result'),
                ImageColumn::make('awayClub.logo_url')
                    ->label(false),
                TextColumn::make('awayClub.name')
                    ->label('Away'),
                TextColumn::make('users_count')->counts('users')
                    ->label('Participants')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
