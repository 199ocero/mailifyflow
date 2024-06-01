<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\SubscriberStatusType;
use App\Models\CampaignEmail;
use App\Models\EmailList;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;

class EngagementMetrics extends ChartWidget
{
    protected static ?string $heading = 'Engagement Metrics';

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $commonQuery = function ($query) {
            $query->where('team_id', Filament::getTenant()->id);
        };

        $emailsDelivered = CampaignEmail::query()
            ->where($commonQuery)
            ->where('delivered_at', '!=', null)
            ->count();

        $emailsBounced = CampaignEmail::query()
            ->where($commonQuery)
            ->where('bounced_at', '!=', null)
            ->count();

        $emailsOpened = CampaignEmail::query()
            ->where($commonQuery)
            ->where('opened_at', '!=', null)
            ->count();

        $emailsClicked = CampaignEmail::query()
            ->where($commonQuery)
            ->sum('click_count');

        $unsubscribe = EmailList::query()
            ->where($commonQuery)
            ->withCount(['subscribers as unsubscribed_count' => function ($query) {
                $query->where('subscribers.status', SubscriberStatusType::UNSUBSCRIBED->value);
            }])
            ->get()
            ->sum('unsubscribed_count');

        $emailsComplaint = CampaignEmail::query()
            ->where($commonQuery)
            ->where('complained_at', '!=', null)
            ->count();

        $bounceRate = round(($emailsBounced / $emailsDelivered) * 100, 2);
        $openRate = round(($emailsOpened / ($emailsDelivered - $emailsBounced)) * 100, 2);
        $clickedThroughRate = round(($emailsClicked / ($emailsDelivered - $emailsBounced)) * 100, 2);
        $unsubscribeRate = round(($unsubscribe / $emailsDelivered) * 100, 2);
        $spamRate = round(($emailsComplaint / $emailsDelivered) * 100, 2);

        return [
            'datasets' => [
                [
                    'label' => 'Engagement Metrics',
                    'data' => [$openRate, $clickedThroughRate, $bounceRate, $unsubscribeRate, $spamRate],
                    'backgroundColor' => '#EA580C',
                    'borderColor' => '#EA580C',
                ],
            ],
            'labels' => ['Open Rate', 'Click-Through Rate (CTR)', 'Bounce Rate', 'Unsubscribe Rate', 'Spam Complaints'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getDescription(): ?string
    {
        return 'These metrics collectively help you understand how well your emails are resonating with your audience and identify areas for improvement.';
    }
}
