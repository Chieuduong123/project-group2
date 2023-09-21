<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\LineChartWidget;

class ApplicationChart extends LineChartWidget
{
    protected static ?string $heading = 'Rate Apply Job Of Business';
    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
        ],
    ];
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
        $business = $business->take(15);

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
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'xAxes' => [
                    [
                        'ticks' => [
                            'maxRotation' => 0,
                            'minRotation' => 0,
                            'callback' => 'function(value) { return value; }',
                        ],
                        'offset' => true,
                        'gridLines' => [
                            'drawBorder' => false,
                        ],
                    ],
                ],
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                            'precision' => 0,
                        ],
                        'gridLines' => [
                            'drawBorder' => false,
                        ],
                    ],
                ],
            ],
            'pan' => [
                'enabled' => true,
                'mode' => 'x',
            ],
            'zoom' => [
                'enabled' => true,
                'mode' => 'x',
            ],
        ];
    }
}
