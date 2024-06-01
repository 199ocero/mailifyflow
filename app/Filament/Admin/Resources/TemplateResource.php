<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Blocks\ButtonBlock;
use App\Filament\Admin\Blocks\ContentBlock;
use App\Filament\Admin\Blocks\QuoteBlock;
use App\Filament\Admin\Resources\TemplateResource\Pages;
use App\Models\Template;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?int $navigationSort = 4;

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
                                You can also use some placeholders like <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{\$subscriber_first_name}}</span> - this will be replaced by the subscriber first name, 
                                <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{\$subscriber_last_name}}</span> - this will be replaced by the subscriber last name, and
                                <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{\$subscriber_email}}</span> - this will be replaced by the subscriber email. You can also
                                use ternary operators like <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{ \$subscriber_first_name ?? \$subscriber_last_name ?? \$subscriber_email}}</span> - if a first name is available, it will be used; otherwise, if a last name is available, it will be used; if neither is available, 
                                the email will be used.");
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
                                    ->modalContent(function (Get $get): ?View {
                                        if ($get('template_content')) {
                                            return view(
                                                'filament.template.preview',
                                                ['content' => json_decode(tiptap_converter()->asJSON($get('template_content')), true)['content']],
                                            );
                                        }

                                        return null;
                                    }),
                            ])
                            ->footerActionsAlignment(Alignment::Center)
                            ->schema([
                                TiptapEditor::make('template_content')
                                    ->profile('mailifyflow')
                                    ->extraInputAttributes([
                                        'style' => 'min-height: 50rem;',
                                    ])
                                    ->blocks([
                                        ButtonBlock::class,
                                        QuoteBlock::class,
                                        ContentBlock::class,
                                    ])
                                    ->required(),
                            ]),
                    ]),
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
