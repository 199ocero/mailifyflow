<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmailListResource\Pages;
use App\Filament\Admin\Resources\EmailListResource\RelationManagers;
use App\Filament\Imports\SubscriberImporter;
use App\Models\EmailList;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\HtmlString;

class EmailListResource extends Resource
{
    protected static ?string $model = EmailList::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Email List')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('List Name')
                            ->placeholder('e.g. My List')
                            ->required()
                            ->string(),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('e.g. List of emails to be sent')
                            ->required(),
                        Forms\Components\Fieldset::make('Controls')
                            ->schema([
                                Forms\Components\Toggle::make('active')
                                    ->label('Active')
                                    ->helperText('If disabled, this list will not be used for sending emails.')
                                    ->default(true)
                                    ->required(),
                                Forms\Components\Toggle::make('default')
                                    ->label('Default')
                                    ->helperText('If enabled, this list will serve as the default list. If no default list exists, the latest list will be used instead.')
                                    ->required(),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(function (string $operation): bool {
                        if ($operation === 'edit') {
                            return true;
                        }

                        return false;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->label('Import Subscribers')
                    ->color('gray')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->importer(SubscriberImporter::class)
                    ->modalHeading('Import Subscribers'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscribersCount')
                    ->label('Subscribers'),
                Tables\Columns\TextColumn::make('duplicateSubscribersCount')
                    ->label('Duplicates'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('default')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('delete_single_email_list')
                    ->label('Delete')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-trash')
                    ->modalHeading(function (EmailList $record) {
                        return new HtmlString("Delete <span class='font-extrabold text-danger-600 dark:text-danger-400'>{$record->name}</span> Email List?");
                    })
                    ->action(function (EmailList $record) {
                        $record->subscribers()->each(function ($subscriber) {
                            $subscriber->delete();
                        });

                        $record->delete();

                        Notification::make()
                            ->success()
                            ->title('Email List Deleted')
                            ->body('Email List has been deleted and all subscribers have been deleted from this list.')
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('delete_email_list')
                        ->label('Delete Email List')
                        ->color('danger')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalDescription('Are you sure you would like to do this? It will also delete all subscribers from this list.')
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                $record->subscribers()->each(function ($subscriber) {
                                    $subscriber->delete();
                                });

                                $record->delete();
                            });

                            Notification::make()
                                ->success()
                                ->title('Email List Deleted')
                                ->body('Email List has been deleted and all subscribers have been deleted from this list.')
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SubscribersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmailLists::route('/'),
            'create' => Pages\CreateEmailList::route('/create'),
            'edit' => Pages\EditEmailList::route('/{record}/edit'),
        ];
    }
}
