<?php

namespace App\Filament\Resources\JoblistResource\Pages;

use App\Filament\Resources\JoblistResource;
use App\Models\Joblist;
use Filament\Actions;
use Filament\Forms\Components\Builder;
use Filament\Resources\Components\Tab; 
use Filament\Resources\Pages\ListRecords;

class ListJoblists extends ListRecords
{
    protected static string $resource = JoblistResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
    
    public function getTabs(): array
    {
        $tabs = [
            'Бүгд' => Tab::make('Бүгд')->badge($this->getModel()::count()),
            'Үндсэн ажилтан' => Tab::make('Үндсэн ажилтан')->badge($this->getModel()::count()),
            'Цагын ажилтан' => Tab::make('Цагын ажилтан')->badge($this->getModel()::count()),
            'Түр ажилтан' => Tab::make('Түр ажилтан')->badge($this->getModel()::count()),
            'Бусад' => Tab::make('Бусад')->badge($this->getModel()::count()),
        
        ];
        return $tabs;
    }

}