<?php

namespace App\Filament\Resources\ProgramQualificationResource\Pages;

use App\Filament\Resources\ProgramQualificationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProgramQualification extends CreateRecord
{
    protected static string $resource = ProgramQualificationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['submitted_by'] = Auth::id();
        return $data;
    }
}
