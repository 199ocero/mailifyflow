<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\SubscriberStatusType;
use App\Models\CampaignEmail;
use App\Models\Subscriber;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;

class CampaignPerformanceMetrics extends ChartWidget
{
    protected static ?string $heading = 'Campaign Performance Metrics';

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 1;

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

        $unsubscribe = Subscriber::query()
            ->where($commonQuery)
            ->where('status', SubscriberStatusType::UNSUBSCRIBED)
            ->count();

        $emailsComplaint = CampaignEmail::query()
            ->where($commonQuery)
            ->where('complained_at', '!=', null)
            ->count();

        if ($emailsDelivered != 0) {
            $bounceRate = round(($emailsBounced / $emailsDelivered) * 100, 2);
            $unsubscribeRate = round(($unsubscribe / $emailsDelivered) * 100, 2);
            $spamRate = round(($emailsComplaint / $emailsDelivered) * 100, 2);
        } else {
            $bounceRate = 0;
            $unsubscribeRate = 0;
            $spamRate = 0;
        }

        if ($emailsDelivered - $emailsBounced != 0) {
            $openRate = round(($emailsOpened / ($emailsDelivered - $emailsBounced)) * 100, 2);
            $clickedThroughRate = round(($emailsClicked / ($emailsDelivered - $emailsBounced)) * 100, 2);
        } else {
            $openRate = 0;
            $clickedThroughRate = 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Campaign Performance Metrics',
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
