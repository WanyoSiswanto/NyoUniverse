<?php

namespace App\Filament\Resources\ProgramCalibrationResource\Pages;

use App\Filament\Resources\ProgramCalibrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramCalibrations extends ListRecords
{
    protected static string $resource = ProgramCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
