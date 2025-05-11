<?php

namespace App\Filament\Resources\JoblistResource\Pages;

use App\Filament\Resources\JoblistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJoblist extends EditRecord
{
    protected static string $resource = JoblistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}