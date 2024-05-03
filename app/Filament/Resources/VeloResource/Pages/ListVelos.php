<?php

namespace App\Filament\Resources\VeloResource\Pages;

use App\Filament\Resources\VeloResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVelos extends ListRecords
{
    protected static string $resource = VeloResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
