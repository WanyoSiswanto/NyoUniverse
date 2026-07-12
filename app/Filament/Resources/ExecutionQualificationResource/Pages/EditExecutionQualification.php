<?php

namespace App\Filament\Resources\ExecutionQualificationResource\Pages;

use App\Filament\Resources\ExecutionQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExecutionQualification extends EditRecord
{
    protected static string $resource = ExecutionQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
