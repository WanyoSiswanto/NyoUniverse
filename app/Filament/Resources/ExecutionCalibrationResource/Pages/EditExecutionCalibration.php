<?php

namespace App\Filament\Resources\ExecutionCalibrationResource\Pages;

use App\Filament\Resources\ExecutionCalibrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExecutionCalibration extends EditRecord
{
    protected static string $resource = ExecutionCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
