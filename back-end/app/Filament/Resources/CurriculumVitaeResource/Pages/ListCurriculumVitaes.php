<?php

namespace App\Filament\Resources\CurriculumVitaeResource\Pages;

use App\Filament\Resources\CurriculumVitaeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurriculumVitaes extends ListRecords
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
