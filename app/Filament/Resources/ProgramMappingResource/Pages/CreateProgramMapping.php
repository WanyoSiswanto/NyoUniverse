<?php

namespace App\Filament\Resources\ProgramMappingResource\Pages;

use App\Filament\Resources\ProgramMappingResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProgramMapping extends CreateRecord
{
    protected static string $resource = ProgramMappingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['submitted_by'] = Auth::id();
        return $data;
    }
}
