<?php

namespace App\Filament\Admin\Resources\EmailListResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Imports\SubscriberRelationImporter;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SubscribersRelationManager extends RelationManager
{
    protected static string $relationship = 'subscribers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->label('Email Address')
                    ->placeholder('e.g. johndoe@gmail.com')
                    ->required()
                    ->email(),
                Forms\Components\TextInput::make('first_name')
                    ->label('First Name')
                    ->placeholder('e.g. John')
                    ->nullable()
                    ->string(),
                Forms\Components\TextInput::make('last_name')
                    ->label('Last Name')
                    ->placeholder('e.g. Doe')
                    ->nullable()
                    ->string(),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->placeholder('No First Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->placeholder('No Last Name')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('subscribers.created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Subscriber')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Add Subscriber'),
                Tables\Actions\ImportAction::make()
                    ->label('Import Subscribers')
                    ->color('gray')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->importer(SubscriberRelationImporter::class)
                    ->modalHeading('Import Subscribers')
                    ->options([
                        'email_list_id' =>  $this->getOwnerRecord()->getKey(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
