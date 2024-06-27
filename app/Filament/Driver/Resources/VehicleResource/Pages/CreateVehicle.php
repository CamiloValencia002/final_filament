<?php

namespace App\Filament\Driver\Resources\VehicleResource\Pages;

use App\Filament\Driver\Resources\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateVehicle extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_driver'] = Auth::user()->id;
        return $data;
    }
    protected static string $resource = VehicleResource::class;
}
