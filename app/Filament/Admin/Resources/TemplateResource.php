<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TemplateResource\Blocks\ButtonBlock;
use App\Filament\Admin\Resources\TemplateResource\Blocks\ContentBlock;
use App\Filament\Admin\Resources\TemplateResource\Blocks\QuoteBlock;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Template;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use App\Filament\Admin\Resources\TemplateResource\Pages;
use Filament\Support\Enums\Alignment;
use FilamentTiptapEditor\TiptapEditor;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Template')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Template Name')
                            ->placeholder('e.g. Newsletter')
                            ->string()
                            ->required(),
                        Forms\Components\Section::make('Template Builder')
                            ->description(function () {
                                return new HtmlString("You can create a template by using the tiptap editor with blocks. 
                                You can also use some placeholders like <span class='font-extrabold text-primary-600 dark:text-primary-400'>{{subscriber_first_name}}</span> - this will be replaced by the subscriber first name, 
                                <span class='font-extrabold text-primary-600 dark:text-primary-400'>{{subscriber_last_name}}</span> - this will be replaced by the subscriber last name, and
                                <span class='font-extrabold text-primary-600 dark:text-primary-400'>{{subscriber_email}}</span> - this will be replaced by the subscriber email.");
                            })
                            ->footerActions([
                                Forms\Components\Actions\Action::make('previewTemplate')
                                    ->label('Preview')
                                    ->icon('heroicon-o-eye')
                                    ->modalIcon('heroicon-o-eye')
                                    ->modalHeading('Preview Template')
                                    ->modalDescription('You can preview your email template here.')
                                    ->modalSubmitAction(false)
                                    ->modalCancelAction(false)
                                    ->modalWidth('6xl')
                                    ->modalContent(fn (Get $get): View => view(
                                        'filament.template.preview',
                                        ['content' => json_decode(tiptap_converter()->asJSON($get('content')), true)['content']],
                                    ))
                            ])
                            ->footerActionsAlignment(Alignment::Center)
                            ->schema([
                                TiptapEditor::make('content')
                                    ->profile('mailifyflow')
                                    ->extraInputAttributes([
                                        'style' => 'min-height: 50rem;'
                                    ])
                                    ->blocks([
                                        ButtonBlock::class,
                                        QuoteBlock::class,
                                        ContentBlock::class
                                    ])
                                    ->required()
                            ])
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
            'index' => Pages\ListTemplates::route('/'),
            'create' => Pages\CreateTemplate::route('/create'),
            'edit' => Pages\EditTemplate::route('/{record}/edit'),
        ];
    }
}
