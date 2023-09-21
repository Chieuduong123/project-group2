<?php

namespace App\Filament\Widgets;

use App\Models\Business;
use App\Models\CurriculumVitae;
use App\Models\Job;
use App\Models\Seeker;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected function getCards(): array
    {
        return [
            Card::make('Totals Business', Business::where('status', 1)->count())
                ->description('The total count of business in the system')
                ->descriptionColor('success'),
            Card::make('Totals Seeker', Seeker::count())
                ->description('The total count of seekers in the system')
                ->descriptionColor('success'),
            Card::make('Totals Jobs', Job::where('status', 1)->count())
                ->description('The total count of jobs in the system')
                ->descriptionColor('success'),
            Card::make('Totals CVs', CurriculumVitae::count())
                ->description('The total count of CVs in the system')
                ->descriptionColor('success'),
        ];
    }
}
