<?php

namespace App\Filament\Resources\MasterQualificationResource\Pages;

use App\Filament\Resources\MasterQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterQualifications extends ListRecords
{
    protected static string $resource = MasterQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
