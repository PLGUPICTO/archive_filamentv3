<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    // protected static ?string $pollingInterval = '10s';
    // protected static bool $isLazy = false;
    protected function getStats(): array
    {
        return [
            Stat::make('Unique views', '195.1k')
            ->description('32k increase')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => '$dispatch("setStatusFilter", "processed")',
            ])
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 5, 3, 20, 4, 17])
            ->color('success'),
            Stat::make('Bounce rate', '21%')
            ->description('7% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
            Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
