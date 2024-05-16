<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmailServiceResource\Pages;
use App\Models\EmailService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmailServiceResource extends Resource
{
    protected static ?string $model = EmailService::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')->nullable()->relationship('team', 'name'),
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('email_service_type_id')->nullable()->relationship('emailServiceType', 'name'),
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
            'index' => Pages\ListEmailServices::route('/'),
            'create' => Pages\CreateEmailService::route('/create'),
            'edit' => Pages\EditEmailService::route('/{record}/edit'),
        ];
    }
}
