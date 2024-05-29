<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Campaign;
use App\Models\Template;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use App\Enum\CampaignStatusType;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\Alignment;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Notifications\Notification;
use App\Filament\Admin\Blocks\QuoteBlock;
use App\Filament\Admin\Blocks\ButtonBlock;
use App\Filament\Admin\Resources\CampaignResource\Pages;
use App\Jobs\CampaignJob;
use Illuminate\Support\Facades\Bus;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?int $navigationSort = 3;

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
                        Forms\Components\TextInput::make('preheader')
                            ->label('Email Preheader')
                            ->placeholder('e.g. Thank you for signing up!')
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
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Select::make('email_list_id')
                                    ->label('Email List')
                                    ->placeholder('Select Email List')
                                    ->required()
                                    ->relationship('emailList', 'name')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('tag_id')
                                    ->label('Filter Email List By Tag')
                                    ->placeholder('Select Tag')
                                    ->relationship('tags', 'name')
                                    ->searchable()
                                    ->multiple()
                                    ->preload()
                                    ->helperText('Only subscribers on the email list with these tags will be included in the campaign.'),
                            ])
                            ->columns(2),
                        Forms\Components\Section::make('Content')
                            ->description(function () {
                                return new HtmlString("The content below will be used inside the template in the <span class='font-extrabold text-primary-600 dark:text-primary-400'>{{content}}</span> placeholder. You can also use some placeholders like <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{\$subscriber_first_name}}</span> - this will be replaced by the subscriber first name, 
                                <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{\$subscriber_last_name}}</span> - this will be replaced by the subscriber last name, and
                                <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{\$subscriber_email}}</span> - this will be replaced by the subscriber email. You can also
                                use ternary operators like <span class='font-extrabold text-primary-600 dark:text-primary-400'>@{{ \$subscriber_first_name ?? \$subscriber_last_name ?? \$subscriber_email}}</span> - if a first name is available, it will be used; otherwise, if a last name is available, it will be used; if neither is available, 
                                the email will be used.");
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
                                    ->modalContent(function (Get $get): View | null {
                                        if ($get('campaign_content') && $get('template_id')) {
                                            $template = Template::find($get('template_id'));
                                            return view('filament.campaign.preview', [
                                                'templateContent' => json_decode(tiptap_converter()->asJSON($template->template_content), true)['content'],
                                                'campaignContent' => json_decode(tiptap_converter()->asJSON($get('campaign_content')), true)['content'],
                                            ]);
                                        }

                                        return null;
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
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'queued' => 'primary',
                        'sending' => 'info',
                        'sent' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(null)
            ->filters([])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('start_campaign')
                        ->label('Start')
                        ->visible(function (Campaign $record) {
                            if (!in_array($record->status, [CampaignStatusType::DRAFT->value])) {
                                return false;
                            }

                            return true;
                        })
                        ->icon('heroicon-o-play')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalIcon('heroicon-o-play')
                        ->modalHeading(function (Campaign $record) {
                            return new HtmlString("Start <span class='font-extrabold text-primary-600 dark:text-primary-400'>{$record->name}</span> Campaign?");
                        })
                        ->modalDescription('Are you sure you want to start this campaign? Once started, it will start the sending process.')
                        ->action(function (Campaign $record) {
                            try {
                                // Fetch the campaign with related email list subscribers and their tags
                                $campaign = Campaign::query()->with([
                                    'emailList.subscribers.tags',
                                    'emailProvider',
                                    'tags'
                                ])->find($record->id);

                                $jobs = [];

                                // Get the tags of the campaign
                                $campaignTags = $campaign->tags->pluck('id')->toArray();

                                $subscribersWithCommonTags = [];

                                foreach ($campaign->emailList->subscribers as $subscriber) {
                                    // Get the tags of the subscriber
                                    $subscriberTags = $subscriber->tags->pluck('id')->toArray();

                                    // Check if there is an intersection between campaign tags and subscriber tags
                                    $commonTags = array_intersect($campaignTags, $subscriberTags);

                                    if (!empty($commonTags)) {
                                        // If there are common tags, add this subscriber to the list
                                        $subscribersWithCommonTags[] = $subscriber;
                                    }
                                }

                                // If no subscribers have common tags, use all subscribers
                                if (empty($subscribersWithCommonTags)) {
                                    $subscribersWithCommonTags = $campaign->emailList->subscribers;
                                }

                                // Create jobs for the selected subscribers
                                foreach ($subscribersWithCommonTags as $subscriber) {
                                    $jobs[] = new CampaignJob($campaign, $subscriber);
                                }

                                $recipient = auth()->user();

                                Bus::batch($jobs)
                                    ->before(function () use ($campaign) {
                                        $campaign->status = CampaignStatusType::QUEUED->value;
                                        $campaign->save();
                                    })
                                    ->then(function () use ($campaign) {
                                        $campaign->status = CampaignStatusType::SENDING->value;
                                        $campaign->save();
                                    })
                                    ->finally(function () use ($campaign, $recipient) {
                                        $campaign->status = CampaignStatusType::SENT->value;
                                        $campaign->save();

                                        Notification::make()
                                            ->success()
                                            ->title('Campaign Sent')
                                            ->body('The campaign has been sent.')
                                            ->sendToDatabase($recipient);
                                    })
                                    ->dispatch();

                                Notification::make()
                                    ->success()
                                    ->title('Campaign Started')
                                    ->body('The campaign has been started.')
                                    ->send();
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->danger()
                                    ->title('Error')
                                    ->body($e->getMessage())
                                    ->send();
                            }
                        }),
                    Tables\Actions\Action::make('cancel_campaign')
                        ->label('Cancel')
                        ->visible(function (Campaign $record) {
                            if (!in_array($record->status, [CampaignStatusType::DRAFT->value])) {
                                return false;
                            }

                            return true;
                        })
                        ->color('gray')
                        ->icon('heroicon-o-x-circle')
                        ->requiresConfirmation()
                        ->modalHeading(function (Campaign $record) {
                            return new HtmlString("Cancel <span class='font-extrabold text-primary-600 dark:text-primary-400'>{$record->name}</span> Campaign?");
                        })
                        ->modalDescription('Are you sure you want to cancel this campaign? Once cancelled, it will no longer be sent and you will need to create a new campaign.')
                        ->action(function (Campaign $record) {
                            $campaign = Campaign::find($record->id);

                            $campaign->status = CampaignStatusType::CANCELLED->value;
                            $campaign->save();

                            Notification::make()
                                ->success()
                                ->title('Campaign Cancelled')
                                ->body('The campaign has been cancelled.')
                                ->send();
                        }),
                    Tables\Actions\EditAction::make()
                        ->color('primary')
                        ->visible(function (Campaign $record) {
                            if ($record->status == CampaignStatusType::DRAFT->value) {
                                return true;
                            }

                            return false;
                        }),
                    Tables\Actions\DeleteAction::make()
                        ->visible(function (Campaign $record) {
                            if (!in_array($record->status, [CampaignStatusType::DRAFT->value])) {
                                return false;
                            }

                            return true;
                        }),
                    Tables\Actions\ReplicateAction::make()
                        ->color('info')
                        ->excludeAttributes(['status'])
                        ->modal(false),
                ])
                    ->button()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->poll();
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
