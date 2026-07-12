<?php

namespace App\Filament\Resources\MasterCalibrationResource\Pages;

use App\Filament\Resources\MasterCalibrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterCalibration extends EditRecord
{
    protected static string $resource = MasterCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
