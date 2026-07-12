<?php

namespace App\Filament\Resources\ProgramCalibrationResource\Pages;

use App\Filament\Resources\ProgramCalibrationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProgramCalibration extends CreateRecord
{
    protected static string $resource = ProgramCalibrationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['submitted_by'] = Auth::id();
        return $data;
    }
}
