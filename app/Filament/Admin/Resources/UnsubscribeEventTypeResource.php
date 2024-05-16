<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UnsubscribeEventTypeResource\Pages;
use App\Models\UnsubscribeEventType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UnsubscribeEventTypeResource extends Resource
{
    protected static ?string $model = UnsubscribeEventType::class;

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
            'index' => Pages\ListUnsubscribeEventTypes::route('/'),
            'create' => Pages\CreateUnsubscribeEventType::route('/create'),
            'edit' => Pages\EditUnsubscribeEventType::route('/{record}/edit'),
        ];
    }
}
