<?php

namespace App\Filament\Driver\Resources\MyTripsResource\Pages;

use App\Filament\Driver\Resources\MyTripsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyTrips extends CreateRecord
{
    protected static string $resource = MyTripsResource::class;
}
