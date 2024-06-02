<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\CampaignLogStatusType;
use App\Models\Campaign;
use App\Models\CampaignEmail;
use App\Models\Subscriber;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $now = Carbon::now();
        $sevenDaysAgo = $now->copy()->subDays(7);

        $commonQuery = function ($query) {
            $query->where('team_id', Filament::getTenant()->id);
        };

        $campaignLogsDelivered = CampaignEmail::query()
            ->where($commonQuery)
            ->where('status', CampaignLogStatusType::DELIVERED)
            ->count();

        $campaignLogsDelivered7Days = CampaignEmail::query()
            ->where($commonQuery)
            ->where('status', CampaignLogStatusType::DELIVERED)
            ->whereBetween('delivered_at', [$sevenDaysAgo, $now])
            ->count();

        $campaigns = Campaign::query()
            ->where($commonQuery)
            ->count();

        $campaigns7Days = Campaign::query()
            ->where($commonQuery)
            ->whereBetween('created_at', [$sevenDaysAgo, $now])
            ->count();

        $subscribersTotal = Subscriber::query()
            ->where($commonQuery)
            ->count();

        $subscribersTotal7Days = Subscriber::query()
            ->where($commonQuery)
            ->whereBetween('created_at', [$sevenDaysAgo, $now])
            ->count();

        return [
            Stat::make('Total Emails Delivered', $campaignLogsDelivered)
                ->icon('heroicon-o-envelope')
                ->description("{$campaignLogsDelivered7Days} email/s delivered in the last 7 days")
                ->descriptionIcon($campaignLogsDelivered7Days > 0 ? 'heroicon-m-arrow-trending-up' : null)
                ->color($campaignLogsDelivered7Days > 0 ? 'success' : 'gray'),
            Stat::make('Total Campaigns', $campaigns)
                ->icon('heroicon-o-megaphone')
                ->description("{$campaigns7Days} campaign/s created in the last 7 days")
                ->descriptionIcon($campaigns7Days > 0 ? 'heroicon-m-arrow-trending-up' : null)
                ->color($campaigns7Days > 0 ? 'success' : 'gray'),
            Stat::make('Total Subscribers', $subscribersTotal)
                ->icon('heroicon-o-users')
                ->description("{$subscribersTotal7Days} subscriber/s imported in the last 7 days")
                ->descriptionIcon($subscribersTotal7Days > 0 ? 'heroicon-m-arrow-trending-up' : null)
                ->color($subscribersTotal7Days > 0 ? 'success' : 'gray'),
        ];
    }
}
