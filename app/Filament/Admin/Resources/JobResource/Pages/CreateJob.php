<?php

namespace App\Filament\Admin\Resources\JobResource\Pages;

use App\Filament\Admin\Resources\JobResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJob extends CreateRecord
{
    protected static string $resource = JobResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}