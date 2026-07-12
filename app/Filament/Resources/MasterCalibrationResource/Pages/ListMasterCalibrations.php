<?php

namespace App\Filament\Resources\MasterCalibrationResource\Pages;

use App\Filament\Resources\MasterCalibrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterCalibrations extends ListRecords
{
    protected static string $resource = MasterCalibrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
