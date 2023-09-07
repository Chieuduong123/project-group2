<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\LineChartWidget;

class ApplicationChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
           
        ];
    }
}
