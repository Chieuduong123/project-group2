<?php

namespace App\Filament\Widgets;

use App\Models\Favorite;
use Filament\Widgets\BarChartWidget;

class FavoriteChart extends BarChartWidget
{
    protected static ?string $heading = 'Rate Favorite of Job Chart';

    protected function getData(): array
    {
        $favorites = Favorite::with(['job.business'])->get();

        $business = $favorites
            ->groupBy('job.business.name')
            ->map(function ($favorites, $businessName) {
                return [
                    'name' => $businessName,
                    'count' => $favorites->count(),
                ];
            })
            ->sortBy('name');

        $chart = [
            'labels' => $business->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Favorites',
                    'data' => $business->pluck('count')->toArray(),
                    'backgroundColor' => $this->colors(),
                ],
            ],
        ];

        return $chart;
    }

    protected function colors()
    {
        return [
            '#EDAB0D',
        ];
    }
}
