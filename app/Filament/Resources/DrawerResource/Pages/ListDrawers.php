<?php

namespace App\Filament\Resources\DrawerResource\Pages;

use Filament\Actions;
use Filament\Tables\Table;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DrawerResource;

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
