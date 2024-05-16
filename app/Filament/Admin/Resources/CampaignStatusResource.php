<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CampaignStatusResource\Pages;
use App\Models\CampaignStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CampaignStatusResource extends Resource
{
    protected static ?string $model = CampaignStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
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
            'index' => Pages\ListCampaignStatuses::route('/'),
            'create' => Pages\CreateCampaignStatus::route('/create'),
            'edit' => Pages\EditCampaignStatus::route('/{record}/edit'),
        ];
    }
}
