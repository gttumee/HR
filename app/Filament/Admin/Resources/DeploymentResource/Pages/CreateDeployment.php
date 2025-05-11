<?php

namespace App\Filament\Admin\Resources\DeploymentResource\Pages;

use App\Filament\Admin\Resources\DeploymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeployment extends CreateRecord
{
    protected static string $resource = DeploymentResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}