<?php

namespace App\Filament\Resources\VeloResource\Pages;

use App\Filament\Resources\VeloResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVelo extends EditRecord
{
    protected static string $resource = VeloResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
