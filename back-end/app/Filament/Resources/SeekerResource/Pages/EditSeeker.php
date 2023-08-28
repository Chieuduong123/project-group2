<?php

namespace App\Filament\Resources\SeekerResource\Pages;

use App\Filament\Resources\SeekerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeeker extends EditRecord
{
    protected static string $resource = SeekerResource::class;

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
