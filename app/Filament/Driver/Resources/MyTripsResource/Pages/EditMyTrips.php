<?php

namespace App\Filament\Driver\Resources\MyTripsResource\Pages;

use App\Filament\Driver\Resources\MyTripsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyTrips extends EditRecord
{
    protected static string $resource = MyTripsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
