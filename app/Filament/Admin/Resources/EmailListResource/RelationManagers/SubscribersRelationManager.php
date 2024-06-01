<?php

namespace App\Filament\Admin\Resources\EmailListResource\RelationManagers;

use App\Enum\SubscriberStatusType;
use App\Filament\Imports\SubscriberRelationImporter;
use App\Models\Tag;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

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
                Forms\Components\Select::make('tags')
                    ->label('Tags')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->nullable()
                    ->multiple(),
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
                Tables\Columns\TextColumn::make('tags.name')
                    ->placeholder('No Tags')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        SubscriberStatusType::SUBSCRIBED->value => 'success',
                        SubscriberStatusType::UNSUBSCRIBED->value => 'danger',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unsubscribe_type')
                    ->label('Unsubscribe Type')
                    ->placeholder('No Unsubscribe Type')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('unsubscribe_at')
                    ->label('Unsubscribe Date')
                    ->placeholder('No Unsubscribe Date')
                    ->date('F j, Y \a\t g:i A', Filament::getTenant()->timezone)
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->deferLoading()
            ->defaultSort('subscribers.created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('tags')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple()
                    ->native(false),
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
                        'email_list_id' => $this->getOwnerRecord()->getKey(),
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('tags')
                        ->label('Assign Tags')
                        ->icon('heroicon-o-tag')
                        ->requiresConfirmation()
                        ->modalIcon('heroicon-o-tag')
                        ->modalHeading('Tags')
                        ->modalSubmitActionLabel('Save')
                        ->modalDescription('You can assign or remove tags from this subscriber.')
                        ->form([
                            Forms\Components\Select::make('tag_id')
                                ->label('Select Tags')
                                ->options(Tag::query()->where('team_id', Filament::getTenant()->id)->pluck('name', 'id'))
                                ->multiple()
                                ->searchable(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $tagIds = $data['tag_id'] ?? [];

                            $records->each(function ($record) use ($tagIds) {
                                $record->tags()->sync($tagIds);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Delete Subscribers'),
                ]),
            ]);
    }
}
