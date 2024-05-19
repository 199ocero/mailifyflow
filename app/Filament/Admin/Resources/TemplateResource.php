<?php

namespace App\Filament\Admin\Resources;

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
                                return new HtmlString("You can create a template by using the block builder. 
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
                                        ['content' => $get('content')],
                                    ))
                            ])
                            ->footerActionsAlignment(Alignment::Center)
                            ->schema([
                                Forms\Components\Builder::make('content')
                                    ->label('Blocks')
                                    ->addActionLabel('Add Block')
                                    ->blocks([
                                        Forms\Components\Builder\Block::make('heading')
                                            ->schema([
                                                Forms\Components\TextInput::make('label')
                                                    ->label('Label')
                                                    ->placeholder('e.g. Newsletter')
                                                    ->required(),
                                                Forms\Components\Select::make('type')
                                                    ->options([
                                                        'h1' => 'Heading 1',
                                                        'h2' => 'Heading 2',
                                                        'h3' => 'Heading 3',
                                                        'h4' => 'Heading 4',
                                                        'h5' => 'Heading 5',
                                                        'h6' => 'Heading 6',
                                                    ])
                                                    ->required(),
                                            ])
                                            ->icon('heroicon-m-bars-2')
                                            ->columns(2),
                                        Forms\Components\Builder\Block::make('paragraph')
                                            ->schema([
                                                Forms\Components\Textarea::make('content')
                                                    ->label('Paragraph')
                                                    ->placeholder('e.g. Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                                                    ->autosize()
                                                    ->required(),
                                            ])
                                            ->icon('heroicon-m-bars-3-bottom-left')
                                            ->columns(1),
                                        Forms\Components\Builder\Block::make('list')
                                            ->schema([
                                                Forms\Components\Group::make()
                                                    ->schema([
                                                        Forms\Components\Select::make('type')
                                                            ->options([
                                                                'bullet' => 'Bullet List',
                                                                'number' => 'Number List',
                                                            ])
                                                            ->required(),
                                                        Forms\Components\TextInput::make('label')
                                                            ->label('Label (optional)')
                                                            ->placeholder('e.g. List')
                                                            ->string(),
                                                    ])
                                                    ->columns(2),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Description (optional)')
                                                    ->placeholder('e.g. Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                                                    ->string(),
                                                Forms\Components\Repeater::make('items')
                                                    ->simple(
                                                        Forms\Components\TextInput::make('content')
                                                            ->label('List Item')
                                                            ->placeholder('e.g. Item 1')
                                                            ->required(),
                                                    )
                                                    ->required()
                                                    ->addActionLabel('Add List Item')
                                            ])
                                            ->icon('heroicon-m-list-bullet')
                                            ->columns(1),
                                        Forms\Components\Builder\Block::make('button')
                                            ->schema([
                                                Forms\Components\Group::make()
                                                    ->schema([
                                                        Forms\Components\TextInput::make('label')
                                                            ->label('Label')
                                                            ->placeholder('e.g. Subscribe')
                                                            ->string()
                                                            ->required(),
                                                        Forms\Components\Select::make('position')
                                                            ->label('Position')
                                                            ->options([
                                                                'left' => 'Left',
                                                                'right' => 'Right',
                                                                'center' => 'Center',
                                                            ])
                                                            ->required(),
                                                        Forms\Components\Select::make('color')
                                                            ->label('Color')
                                                            ->options(
                                                                collect(Color::all())
                                                                    ->mapWithKeys(fn ($color, $name) => [$name => "<div class='flex items-center justify-between gap-4'>
                                                            <div class='w-4 h-4 rounded-full' style='background:rgb(" . $color[500] . ")'></div>
                                                            <span>" . str($name)->title() . '</span>
                                                            </div>'])
                                                                    ->reverse()
                                                            )
                                                            ->allowHtml()
                                                            ->required(),
                                                    ])
                                                    ->columns(3),
                                                Forms\Components\Group::make()
                                                    ->schema([
                                                        Forms\Components\TextInput::make('url')
                                                            ->label('Url')
                                                            ->placeholder('e.g. https://example.com')
                                                            ->url()
                                                            ->required(),
                                                        Forms\Components\Select::make('target')
                                                            ->label('Target')
                                                            ->options([
                                                                '_blank' => 'Open in New Tab',
                                                                '_self' => 'Open in Same Tab',
                                                            ])
                                                            ->required(),
                                                    ])
                                                    ->columns(2)
                                            ])
                                            ->icon('heroicon-m-cursor-arrow-ripple')
                                            ->columns(1),
                                        Forms\Components\Builder\Block::make('divider')
                                            ->schema([
                                                Forms\Components\Select::make('color')
                                                    ->options(
                                                        collect(Color::all())
                                                            ->mapWithKeys(fn ($color, $name) => [$name => "<div class='flex items-center justify-between gap-4'>
                                                            <div class='w-4 h-4 rounded-full' style='background:rgb(" . $color[500] . ")'></div>
                                                            <span>" . str($name)->title() . '</span>
                                                            </div>'])
                                                            ->reverse()
                                                    )
                                                    ->allowHtml()
                                                    ->required(),
                                            ])
                                            ->icon('heroicon-m-arrows-up-down')
                                            ->columns(1),
                                        Forms\Components\Builder\Block::make('quote')
                                            ->schema([
                                                Forms\Components\Textarea::make('label')
                                                    ->label('Quote')
                                                    ->placeholder('e.g. Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                                                    ->autosize()
                                                    ->required(),
                                                Forms\Components\Select::make('color')
                                                    ->options(
                                                        collect(Color::all())
                                                            ->mapWithKeys(fn ($color, $name) => [$name => "<div class='flex items-center justify-between gap-4'>
                                                            <div class='w-4 h-4 rounded-full' style='background:rgb(" . $color[500] . ")'></div>
                                                            <span>" . str($name)->title() . '</span>
                                                            </div>'])
                                                            ->reverse()
                                                    )
                                                    ->allowHtml()
                                                    ->required(),
                                            ])
                                            ->icon('heroicon-m-chat-bubble-bottom-center-text')
                                            ->columns(2),
                                        Forms\Components\Builder\Block::make('code')
                                            ->label('Code Snippet')
                                            ->schema([
                                                Forms\Components\Textarea::make('content')
                                                    ->label('Content')
                                                    ->placeholder('e.g. <p>Hello world</p>')
                                                    ->autosize()
                                                    ->helperText('Note: This is not custom HTML or CSS code. It is a code block same format with quotes.')
                                                    ->required()
                                            ])
                                            ->icon('heroicon-m-code-bracket')
                                            ->columns(1),
                                    ])
                                    ->collapsible()
                                    ->cloneable()
                                    ->blockNumbers(false)
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
