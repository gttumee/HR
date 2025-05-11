<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Deployment;
use App\Models\Employee;
use App\Models\Joblist;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Нийт хэлтэс', Deployment::query()->count())
            ->color('success')
            ->icon('heroicon-s-swatch'),
            Stat::make('Нийт бүртгэлтэй ажилтан', Employee::query()->count())
            ->color('success')
            ->icon('heroicon-s-user-group'),
            Stat::make('Нийт зарлагдсан ажилын байр', Joblist::query()->count())
            ->icon('heroicon-m-megaphone')
            ->color('success'),
        ];
    }
}