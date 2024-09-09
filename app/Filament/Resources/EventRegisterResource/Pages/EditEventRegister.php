<?php

namespace App\Filament\Resources\EventRegisterResource\Pages;

use App\Filament\Resources\EventRegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventRegister extends EditRecord
{
    protected static string $resource = EventRegisterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
