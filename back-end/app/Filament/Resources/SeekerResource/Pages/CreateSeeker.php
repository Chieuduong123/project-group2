<?php

namespace App\Filament\Resources\SeekerResource\Pages;

use App\Filament\Resources\SeekerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeeker extends CreateRecord
{
    protected static string $resource = SeekerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
