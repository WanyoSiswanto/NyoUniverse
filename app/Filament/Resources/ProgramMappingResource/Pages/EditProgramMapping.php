<?php

namespace App\Filament\Resources\ProgramMappingResource\Pages;

use App\Filament\Resources\ProgramMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramMapping extends EditRecord
{
    protected static string $resource = ProgramMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
