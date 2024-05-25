<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Campaign;
use App\Models\Template;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\Alignment;
use FilamentTiptapEditor\TiptapEditor;
use App\Filament\Admin\Blocks\QuoteBlock;
use App\Filament\Admin\Blocks\ButtonBlock;
use App\Filament\Admin\Resources\CampaignResource\Pages;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Campaign')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Campaign Name')
                            ->placeholder('e.g. My Campaign')
                            ->string()
                            ->required(),
                        Forms\Components\TextInput::make('subject')
                            ->label('Email Subject')
                            ->placeholder('e.g. Welcome to MailifyFlow')
                            ->string()
                            ->required(),
                        Forms\Components\Group::make()
                            ->schema([
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
                            ])
                            ->columns(2),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Select::make('template_id')
                                    ->label('Template')
                                    ->placeholder('Select Template')
                                    ->required()
                                    ->relationship('template', 'name')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('email_provider_id')
                                    ->label('Email Provider')
                                    ->placeholder('Select Email Provider')
                                    ->required()
                                    ->relationship('emailProvider', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->live(onBlur: true),
                            ])
                            ->columns(2),
                        Forms\Components\Section::make('Content')
                            ->description(function () {
                                return new HtmlString("The content below will be used inside the template in the <span class='font-extrabold text-primary-600 dark:text-primary-400'>{{content}}</span> placeholder.");
                            })
                            ->footerActions([
                                Forms\Components\Actions\Action::make('previewCampaign')
                                    ->label('Preview')
                                    ->icon('heroicon-o-eye')
                                    ->modalIcon('heroicon-o-eye')
                                    ->modalHeading('Preview Campaign')
                                    ->modalDescription('You can preview your campaign here.')
                                    ->modalSubmitAction(false)
                                    ->modalCancelAction(false)
                                    ->modalWidth('6xl')
                                    ->modalContent(function (Get $get): View {
                                        $template = Template::find($get('template_id'));
                                        return view('filament.campaign.preview', [
                                            'templateContent' => json_decode(tiptap_converter()->asJSON($template->template_content), true)['content'],
                                            'campaignContent' => json_decode(tiptap_converter()->asJSON($get('campaign_content')), true)['content'],
                                        ]);
                                    })
                            ])
                            ->footerActionsAlignment(Alignment::Center)
                            ->schema([
                                TiptapEditor::make('campaign_content')
                                    ->profile('mailifyflow')
                                    ->extraInputAttributes([
                                        'style' => 'min-height: 50rem;'
                                    ])
                                    ->blocks([
                                        ButtonBlock::class,
                                        QuoteBlock::class,
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
