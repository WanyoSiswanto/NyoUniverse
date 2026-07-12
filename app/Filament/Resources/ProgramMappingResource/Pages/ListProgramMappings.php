<?php

namespace App\Filament\Resources\ProgramMappingResource\Pages;

use App\Filament\Resources\ProgramMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramMappings extends ListRecords
{
    protected static string $resource = ProgramMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
