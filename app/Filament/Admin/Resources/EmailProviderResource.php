<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EmailProvider;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use App\Models\EmailProviderType;
use App\Filament\Admin\Resources\EmailProviderResource\Pages;
use Illuminate\Support\HtmlString;

class EmailProviderResource extends Resource
{
    protected static ?string $model = EmailProvider::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Email Provider')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Email Provider Name')
                            ->placeholder('e.g. Amazon SES')
                            ->string()
                            ->required(),
                        Forms\Components\Section::make('SMTP Credentials')
                            ->description(function () {
                                return new HtmlString("<span class='font-extrabold text-red-600 dark:text-red-400'>Note: To track email delivery, bounces, clicks, opens, etc., please ensure you add your AWS key, secret, and region in the .env variable. The system is currently configured only for AWS SES and if you don't want to track any of this and just want to send emails, you can try adding another SMTP server, but we cannot guarantee it will work.</span>");
                            })
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('host')
                                            ->label('Host')
                                            ->placeholder('e.g. smtp.amazon.com')
                                            ->string()
                                            ->required(),
                                        Forms\Components\TextInput::make('port')
                                            ->label('Port')
                                            ->placeholder('e.g. 465')
                                            ->integer()
                                            ->required(),
                                        Forms\Components\TextInput::make('encryption')
                                            ->label('Encryption')
                                            ->placeholder('e.g. tls')
                                            ->string()
                                            ->required(),
                                    ])
                                    ->columns(3),
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('username')
                                            ->label('Username')
                                            ->placeholder('e.g. email@example.com')
                                            ->string()
                                            ->required(),
                                        Forms\Components\TextInput::make('password')
                                            ->label('Password')
                                            ->placeholder('e.g. 123456')
                                            ->password()
                                            ->revealable()
                                            ->required(),
                                    ])
                                    ->columns(2)
                            ])
                            ->columns(1)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

            ])
            ->filters([])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmailProviders::route('/'),
            'create' => Pages\CreateEmailProvider::route('/create'),
            'edit' => Pages\EditEmailProvider::route('/{record}/edit'),
        ];
    }
}
