<?php

namespace App\Filament\Resources\MasterQualificationResource\Pages;

use App\Filament\Resources\MasterQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterQualification extends EditRecord
{
    protected static string $resource = MasterQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
