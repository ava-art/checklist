<?php

namespace App\Filament\Resources\RentListResource\Pages;

use App\Filament\Resources\RentListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRentList extends EditRecord
{
    protected static string $resource = RentListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
