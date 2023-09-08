<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\LineChartWidget;

class ApplicationChart extends LineChartWidget
{
    protected static ?string $heading = 'Rate Apply Job Of Business';

    protected function getData(): array
    {
        $applications = Application::with(['job.business'])->get();

        $business = $applications
            ->groupBy('job.business.name')
            ->map(function ($applications, $businessName) {
                return [
                    'name' => $businessName,
                    'count' => $applications->count(),
                ];
            })
            ->sortBy('name');

        $chart = [
            'labels' => $business->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $business->pluck('count')->toArray(),
                ],
            ],
        ];

        return $chart;
    }
}
