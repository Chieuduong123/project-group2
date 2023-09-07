<?php

namespace App\Filament\Resources\CurriculumVitaeResource\Pages;

use App\Filament\Resources\CurriculumVitaeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurriculumVitae extends EditRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
