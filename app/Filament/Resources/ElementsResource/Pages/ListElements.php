<?php

namespace App\Filament\Resources\ElementsResource\Pages;

use App\Filament\Resources\ElementsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListElements extends ListRecords
{
    protected static string $resource = ElementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
