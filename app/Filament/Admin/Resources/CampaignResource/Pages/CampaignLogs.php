<?php

namespace App\Filament\Admin\Resources\CampaignResource\Pages;

use App\Enum\CampaignLogStatusType;
use App\Enum\CampaignStatusType;
use App\Filament\Admin\Resources\CampaignResource;
use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampaignLogs extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithRecord;
    use InteractsWithTable;

    protected static string $resource = CampaignResource::class;

    protected static string $view = 'filament.admin.resources.campaign-resource.pages.campaign-logs';

    protected ?string $heading = null;

    protected ?string $subheading = null;

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        if (! $this->record) {
            abort(404);
        }

        if (! in_array($this->record->status, [
            CampaignStatusType::FAILED->value,
            CampaignStatusType::SENT->value,
            CampaignStatusType::SENT_WITH_FAILURE->value,
        ])) {
            abort(403);
        }
    }

    public function getHeading(): string|Htmlable
    {
        return $this->getRecord()->name;
    }

    public function getSubheading(): string|Htmlable|null
    {
        return "Detailed Log of Activities for the {$this->getRecord()->name} Campaign";
    }

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn (): HasMany => $this->getRecord()->campaignEmails())
            ->inverseRelationship('campaignEmails')
            ->deferLoading()
            ->columns([
                Tables\Columns\TextColumn::make('subscriber.email')
                    ->label('Email Address')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->wrapHeader(),
                Tables\Columns\TextColumn::make('subscriber.first_name')
                    ->label('First Name')
                    ->placeholder('No First Name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('subscriber.last_name')
                    ->label('Last Name')
                    ->placeholder('No Last Name')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->wrapHeader(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        CampaignLogStatusType::BOUNCE->value => 'danger',
                        CampaignLogStatusType::COMPLAINT->value => 'purple',
                        CampaignLogStatusType::SENDING->value => 'blue',
                        CampaignLogStatusType::SENT->value => 'success',
                        CampaignLogStatusType::DELIVERED->value => 'teal',
                        CampaignLogStatusType::REJECTED->value => 'pink',
                        CampaignLogStatusType::FAILED->value => 'gray',
                        CampaignLogStatusType::RENDERING_FAILURE->value => 'orange',
                        CampaignLogStatusType::DELIVERY_DELAY->value => 'yellow',
                    })
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->wrapHeader(),
            ])
            ->defaultSort('sent_at', 'asc')
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->modalIcon('heroicon-s-document-magnifying-glass')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalHeading('View Full Log')
                    ->modalDescription('Full log of activities for this subscriber.')
                    ->stickyModalHeader()
                    ->stickyModalFooter()
                    ->infolist([
                        Infolists\Components\Fieldset::make('Personal Information')
                            ->schema([
                                Infolists\Components\TextEntry::make('subscriber.email')
                                    ->label('Email Address'),
                                Infolists\Components\TextEntry::make('subscriber.first_name')
                                    ->label('First Name')
                                    ->placeholder('No First Name'),
                                Infolists\Components\TextEntry::make('subscriber.last_name')
                                    ->label('Last Name')
                                    ->placeholder('No Last Name'),
                            ])
                            ->columns(3),
                        Infolists\Components\Fieldset::make('Status')
                            ->schema([
                                Infolists\Components\TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        CampaignLogStatusType::BOUNCE->value => 'danger',
                                        CampaignLogStatusType::COMPLAINT->value => 'purple',
                                        CampaignLogStatusType::SENDING->value => 'blue',
                                        CampaignLogStatusType::SENT->value => 'success',
                                        CampaignLogStatusType::DELIVERED->value => 'teal',
                                        CampaignLogStatusType::REJECTED->value => 'pink',
                                        CampaignLogStatusType::FAILED->value => 'gray',
                                        CampaignLogStatusType::RENDERING_FAILURE->value => 'orange',
                                        CampaignLogStatusType::DELIVERY_DELAY->value => 'yellow',
                                    }),
                                Infolists\Components\TextEntry::make('reason_failed')
                                    ->label('Reason of Failure')
                                    ->placeholder('No Reason of Failure'),
                            ])
                            ->columns(2),
                        Infolists\Components\Fieldset::make('Statistics')
                            ->schema([
                                Infolists\Components\TextEntry::make('open_count')
                                    ->label('Opens')
                                    ->numeric(),
                                Infolists\Components\TextEntry::make('click_count')
                                    ->label('Clicks')
                                    ->numeric(),
                            ])
                            ->columns(2),
                        Infolists\Components\Fieldset::make('Dates')
                            ->schema([
                                Infolists\Components\TextEntry::make('queued_at')
                                    ->label('Queued')
                                    ->placeholder('No Date of Queued')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                                Infolists\Components\TextEntry::make('sent_at')
                                    ->label('Sent')
                                    ->placeholder('No Date of Sent')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                                Infolists\Components\TextEntry::make('delivered_at')
                                    ->label('Delivered')
                                    ->placeholder('No Date of Delivery')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                                Infolists\Components\TextEntry::make('opened_at')
                                    ->label('Opened')
                                    ->placeholder('No Date of Opened')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                                Infolists\Components\TextEntry::make('clicked_at')
                                    ->label('Clicked')
                                    ->placeholder('No Date of Clicked')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                                Infolists\Components\TextEntry::make('bounced_at')
                                    ->label('Bounced')
                                    ->placeholder('No Date of Bounced')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                                Infolists\Components\TextEntry::make('unsubscribed_at')
                                    ->label('Unsubscribed')
                                    ->placeholder('No Date of Unsubscribed')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                                Infolists\Components\TextEntry::make('complained_at')
                                    ->label('Complained')
                                    ->placeholder('No Date of Complained')
                                    ->dateTime('F j, Y \a\t g:i A', Filament::getTenant()->timezone),
                            ])
                            ->columns(3),
                    ]),
            ])
            ->bulkActions([
                // ...
            ])
            ->emptyStateHeading('No logs found.');
    }
}
