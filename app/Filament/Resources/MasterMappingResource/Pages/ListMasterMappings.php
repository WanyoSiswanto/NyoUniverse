<?php

namespace App\Filament\Resources\MasterMappingResource\Pages;

use App\Filament\Resources\MasterMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterMappings extends ListRecords
{
    protected static string $resource = MasterMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
