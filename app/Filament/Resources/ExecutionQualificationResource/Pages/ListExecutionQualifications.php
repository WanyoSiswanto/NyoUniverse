<?php

namespace App\Filament\Resources\ExecutionQualificationResource\Pages;

use App\Filament\Resources\ExecutionQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExecutionQualifications extends ListRecords
{
    protected static string $resource = ExecutionQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
