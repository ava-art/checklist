<?php

namespace App\Filament\Resources\RentListResource\Pages;

use App\Filament\Resources\RentListResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRentList extends ViewRecord
{
    protected static string $resource = RentListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
