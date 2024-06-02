<?php

namespace App\Filament\Admin\Widgets;

use App\Enum\SubscriberStatusType;
use App\Models\Subscriber;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ListGrowthQualityMetrics extends ChartWidget
{
    protected static ?string $heading = 'List Growth and Quality Metrics';

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 1;

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $commonQuery = function ($query) {
            $query->where('team_id', Filament::getTenant()->id);
        };

        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Initialize an array to store list growth rates
        $listGrowthRates = [];

        // Initialize an array to store church rates
        $churnRates = [];

        $months = [];

        $totalSubscribers = Subscriber::query()
            ->where($commonQuery)
            ->count();

        // Loop through the last 12 months
        for ($i = 0; $i < 12; $i++) {
            // Calculate the month and year for the current iteration
            $month = $currentMonth - $i;
            $year = $currentYear;
            if ($month <= 0) {
                $month += 12;
                $year--;
            }

            // Get the start and end dates for the current month
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

            // Get new subscribers for the current month
            $newSubscribers = Subscriber::query()
                ->where($commonQuery)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('status', SubscriberStatusType::SUBSCRIBED)
                ->count();

            // Get unsubscribed subscribers for the current month
            $unsubscribedSubscribers = Subscriber::query()
                ->where($commonQuery)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('status', SubscriberStatusType::UNSUBSCRIBED)
                ->count();

            // Calculate the list growth rate for the current month
            $listGrowthRate =
                $totalSubscribers != 0
                ? round((($newSubscribers - $unsubscribedSubscribers) / $totalSubscribers) * 100, 2)
                : 0;

            // Calculate the churn rate for the current month
            $churnRate = ($totalSubscribers != 0) ? round(($unsubscribedSubscribers / $totalSubscribers) * 100, 2) : 0;

            // Store the list growth rate for the current month
            $listGrowthRates[] = $listGrowthRate;

            // Store the churn rate for the current month
            $churnRates[] = $churnRate;

            // Store the month
            $months[] = $startDate->format('F');
        }

        return [
            'datasets' => [
                [
                    'label' => 'List Growth Rate',
                    'data' => array_reverse($listGrowthRates),
                    'backgroundColor' => '#DB2777',
                    'borderColor' => '#DB2777',
                ],
                [
                    'label' => 'Churn Rate',
                    'data' => array_reverse($churnRates),
                    'backgroundColor' => '#2563EB',
                    'borderColor' => '#2563EB',
                ],
            ],
            'labels' => array_reverse($months),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getDescription(): ?string
    {
        return 'Track the expansion and health of your email list to understand subscriber acquisition and retention.';
    }
}
