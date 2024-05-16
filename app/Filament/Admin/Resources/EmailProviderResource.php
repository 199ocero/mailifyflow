<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmailServiceResource\Pages;
use App\Models\EmailProvider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmailProviderResource extends Resource
{
    protected static ?string $model = EmailProvider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')->nullable()->relationship('team', 'name'),
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('email_provider_type_id')->nullable()->relationship('emailProviderType', 'name'),
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
            'index' => Pages\ListEmailProviders::route('/'),
            'create' => Pages\CreateEmailProvider::route('/create'),
            'edit' => Pages\EditEmailProvider::route('/{record}/edit'),
        ];
    }
}
