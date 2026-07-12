<?php

namespace App\Filament\Resources\ProgramQualificationResource\Pages;

use App\Filament\Resources\ProgramQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramQualifications extends ListRecords
{
    protected static string $resource = ProgramQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
