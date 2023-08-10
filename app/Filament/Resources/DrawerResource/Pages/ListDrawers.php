<?php

namespace App\Filament\Resources\DrawerResource\Pages;

use App\Filament\Resources\DrawerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDrawers extends ListRecords
{
    protected static string $resource = DrawerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
