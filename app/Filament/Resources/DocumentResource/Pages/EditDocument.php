<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use Filament\Actions;
use App\Models\Folder;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DocumentResource;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function mutateFormDataBeforeFill(array $data): array
    {
        $folder = Folder::findOrFail($data['folder_id']);

        $data['drawer_id'] = $folder->drawer_id;

        return $data;
    }
}
