<?php

namespace App\Filament\Resources\MasterMappingResource\Pages;

use App\Filament\Resources\MasterMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterMapping extends EditRecord
{
    protected static string $resource = MasterMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
