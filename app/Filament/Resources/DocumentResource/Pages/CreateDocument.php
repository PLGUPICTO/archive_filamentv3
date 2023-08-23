<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use Filament\Actions;
use App\Models\Folder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\DocumentResource;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    public function mount(): void
    {
        // abort_unless(auth()->user()->canManageSettings(), 403);
        abort_unless(true, 403);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}

