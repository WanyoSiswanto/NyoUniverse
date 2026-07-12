<?php

namespace App\Filament\Resources\ExecutionMappingResource\Pages;

use App\Filament\Resources\ExecutionMappingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExecutionMapping extends EditRecord
{
    protected static string $resource = ExecutionMappingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
