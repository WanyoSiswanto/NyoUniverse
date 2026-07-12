<?php

namespace App\Filament\Resources\ProgramQualificationResource\Pages;

use App\Filament\Resources\ProgramQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramQualification extends EditRecord
{
    protected static string $resource = ProgramQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
