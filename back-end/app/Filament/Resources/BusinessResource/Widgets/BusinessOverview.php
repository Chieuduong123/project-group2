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
        return [
            Card::make('All Business', Business::all()->count()),
        ];
    }
}
