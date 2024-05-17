<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Campaign;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Admin\Resources\CampaignResource\Pages;
use AbdelhamidErrahmouni\FilamentMonacoEditor\MonacoEditor;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Campaign')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Campaign Name')
                            ->placeholder('e.g. Newsletter')
                            ->string()
                            ->required(),
                        Forms\Components\TextInput::make('subject')
                            ->label('Email Subject')
                            ->placeholder('e.g. Welcome to MailifyFlow')
                            ->string()
                            ->required(),
                        Forms\Components\TextInput::make('from_name')
                            ->label('From Name')
                            ->placeholder('e.g. MailifyFlow')
                            ->string()
                            ->required(),
                        Forms\Components\TextInput::make('from_email')
                            ->label('From Email')
                            ->placeholder('e.g. mailifyflow@example.com')
                            ->string()
                            ->required(),
                        Forms\Components\Select::make('template_id')
                            ->label('Template')
                            ->placeholder('Select Template')
                            ->required()
                            ->relationship('template', 'name'),
                        Forms\Components\Select::make('email_provider_id')
                            ->label('Email Provider')
                            ->placeholder('Select Email Provider')
                            ->required()
                            ->relationship('emailProvider', 'name'),
                        MonacoEditor::make('content')
                            ->language('html')
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Campaign Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Email Subject')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
