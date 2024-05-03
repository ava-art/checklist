<?php

namespace App\Filament\Resources\ElementsResource\Pages;

use App\Filament\Resources\ElementsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditElements extends EditRecord
{
    protected static string $resource = ElementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
