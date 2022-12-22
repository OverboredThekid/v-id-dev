<?php

namespace App\Filament\Resources\StaffPrintResource\Pages;

use App\Filament\Resources\StaffPrintResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStaffPrint extends EditRecord
{
    protected static string $resource = StaffPrintResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
