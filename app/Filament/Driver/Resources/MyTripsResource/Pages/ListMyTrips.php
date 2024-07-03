<?php

namespace App\Filament\Driver\Resources\MyTripsResource\Pages;

use App\Filament\Driver\Resources\MyTripsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyTrips extends ListRecords
{
    protected static string $resource = MyTripsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
