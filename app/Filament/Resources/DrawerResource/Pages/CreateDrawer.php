<?php

namespace App\Filament\Resources\DrawerResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use App\Filament\Resources\DrawerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDrawer extends CreateRecord
{
    protected static string $resource = DrawerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);
        $data['office_id'] = 1;

        return $data;
    }
}
