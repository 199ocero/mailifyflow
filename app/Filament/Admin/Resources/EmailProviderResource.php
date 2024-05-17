<?php

namespace App\Filament\Admin\Resources;
use App\Models\EmailProvider;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\EmailProviderType;
use App\Filament\Admin\Resources\EmailServiceResource\Pages;

class EmailProviderResource extends Resource
{
    protected static ?string $model = EmailProvider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        $emailProviderType = EmailProviderType::query()->get();

        return $form
            ->schema([
                Forms\Components\Section::make('Email Provider')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Email Provider Name')
                            ->placeholder('e.g. Amazon SES')
                            ->string()
                            ->required(),
                        Forms\Components\Select::make('email_provider_type_id')
                            ->label('Email Provider Type')
                            ->placeholder('Select Provider Type')
                            ->relationship('emailProviderType', 'name')
                            ->required()
                            ->live(onBlur: true),
                        Forms\Components\Section::make(function (Get $get) use ($emailProviderType) {
                            if ($get('email_provider_type_id')) {
                                return $emailProviderType->find($get('email_provider_type_id'))->name . ' Configuration';
                            }
                            return 'Config';
                        })
                            ->description('Enter your email provider credentials below. Rest assured your credentials are safe and encrypted.')
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
                            ->visible(function (Get $get) {
                                return $get('email_provider_type_id') != null;
                            })
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),

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
            'index' => Pages\ListEmailProviders::route('/'),
            'create' => Pages\CreateEmailProvider::route('/create'),
            'edit' => Pages\EditEmailProvider::route('/{record}/edit'),
        ];
    }
}
