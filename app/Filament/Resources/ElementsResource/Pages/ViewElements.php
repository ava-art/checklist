<?php

namespace App\Filament\Resources\ElementsResource\Pages;

use App\Filament\Resources\ElementsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewElements extends ViewRecord
{
    protected static string $resource = ElementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
