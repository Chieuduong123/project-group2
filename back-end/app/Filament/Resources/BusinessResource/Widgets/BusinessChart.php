<?php

namespace App\Filament\Resources\BusinessResource\Widgets;

use App\Models\Business;
use Filament\Widgets\LineChartWidget;

class BusinessChart extends LineChartWidget
{
    protected static ?string $heading = 'Job Views by Business';

    protected function getData(): array
    {
        $businesses = $this->getDataForChart();

        $chartData = $businesses->flatMap(function ($business) {
            return $business['jobs']->map(function ($job) use ($business) {
                return [
                    'x' => $business['name'], 
                    'y' => $job['view_count'], 
                    'title' => $job['title'], 
                    'view_count' => $job['view_count'], 
                ];
            });
        });

        return [
            'datasets' => [
                [
                    'data' => $chartData->toArray(),
                    'label' => 'Job Views',
                ],
            ],
        ];
    }

    protected function getDataForChart()
    {
        $businesses = Business::where('status', 1)->with(['jobs' => function ($query) {
            $query->where('status', 1);
        }])->get();

        $businessesWithJobs = $businesses->map(function ($business) {
            $business['jobs'] = $business->jobs;
            return $business;
        });

        return $businessesWithJobs;
    }
}
