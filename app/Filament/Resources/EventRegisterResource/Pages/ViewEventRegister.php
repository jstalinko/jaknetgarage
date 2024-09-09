<?php

namespace App\Filament\Resources\EventRegisterResource\Pages;

use App\Filament\Resources\EventRegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEventRegister extends ViewRecord
{
    protected static string $resource = EventRegisterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
