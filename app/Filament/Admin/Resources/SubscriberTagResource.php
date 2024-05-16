<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SubscriberTagResource\Pages;
use App\Models\SubscriberTag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriberTagResource extends Resource
{
    protected static ?string $model = SubscriberTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')->nullable()->relationship('team', 'name'),
                Forms\Components\Select::make('tag_id')->nullable()->relationship('tag', 'name'),
                Forms\Components\Select::make('subscriber_id')->nullable()->relationship('subscriber', 'name'),
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
            'index' => Pages\ListSubscriberTags::route('/'),
            'create' => Pages\CreateSubscriberTag::route('/create'),
            'edit' => Pages\EditSubscriberTag::route('/{record}/edit'),
        ];
    }
}
