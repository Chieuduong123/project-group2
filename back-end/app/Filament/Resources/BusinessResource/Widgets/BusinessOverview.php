<?php

namespace App\Filament\Resources\BusinessResource\Widgets;

use App\Models\Business;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BusinessOverview extends BaseWidget
{


    protected function getCards(): array
    {
        // $businessesWithAccesses = Business::leftJoin('job_views', 'businesses.id', '=', 'job_views.business_id')
        //     ->select('businesses.id', 'businesses.name', DB::raw('COUNT(job_views.id) as access_count'))
        //     ->where('businesses.status', 1)
        //     ->groupBy('businesses.id', 'businesses.name')
        //     ->get();
        return [
            Card::make('All Business', Business::where('status', 1)->count()),
            // NumberWidget::make('All Business', $businessesWithAccesses->sum('access_count')),
            // NumberWidget::make('Accesses by Business')->data($businessesWithAccesses, 'name', 'access_count'),
        ];
    }
}
