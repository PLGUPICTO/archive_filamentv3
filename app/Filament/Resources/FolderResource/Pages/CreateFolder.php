<?php

namespace App\Filament\Resources\FolderResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use App\Filament\Resources\FolderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFolder extends CreateRecord
{
    protected static string $resource = FolderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);

        return $data;
    }
}
