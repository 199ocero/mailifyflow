<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CampaignEmailResource\Pages;
use App\Models\CampaignEmail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CampaignEmailResource extends Resource
{
    protected static ?string $model = CampaignEmail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')->nullable()->relationship('team', 'name'),
                Forms\Components\Select::make('subscriber_id')->nullable()->relationship('subscriber', 'name'),
                Forms\Components\TextInput::make('subject'),
                Forms\Components\TextInput::make('from_name'),
                Forms\Components\TextInput::make('from_email'),
                Forms\Components\TextInput::make('open_count')->numeric()->label('Open_count'),
                Forms\Components\TextInput::make('click_count')->numeric()->label('Click_count'),
                Forms\Components\DateTimePicker::make('queued_at')->time(false)->label('Queued_at'),
                Forms\Components\DateTimePicker::make('sent_at')->time(false)->label('Sent_at'),
                Forms\Components\DateTimePicker::make('delivered_at')->time(false)->label('Delivered_at'),
                Forms\Components\DateTimePicker::make('bounced_at')->time(false)->label('Bounced_at'),
                Forms\Components\DateTimePicker::make('unsubscribed_at')->time(false)->label('Unsubscribed_at'),
                Forms\Components\DateTimePicker::make('complained_at')->time(false),
                Forms\Components\DateTimePicker::make('opened_at')->time(false)->label('Opened_at'),
                Forms\Components\DateTimePicker::make('clicked_at')->time(false)->label('Clicked_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')->searchable(),
                Tables\Columns\TextColumn::make('from_name')->searchable(),
                Tables\Columns\TextColumn::make('from_email')->searchable(),

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
            'index' => Pages\ListCampaignEmails::route('/'),
            'create' => Pages\CreateCampaignEmail::route('/create'),
            'edit' => Pages\EditCampaignEmail::route('/{record}/edit'),
        ];
    }
}
