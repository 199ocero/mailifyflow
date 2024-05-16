<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TeamUserResource\Pages;
use App\Models\TeamUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamUserResource extends Resource
{
    protected static ?string $model = TeamUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')->nullable()->relationship('team', 'name'),
                Forms\Components\Select::make('user_id')->nullable()->relationship('user', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamUsers::route('/'),
            'create' => Pages\CreateTeamUser::route('/create'),
            'edit' => Pages\EditTeamUser::route('/{record}/edit'),
        ];
    }
}
