<?php

namespace App\Filament\Driver\Resources\DriverResource\Pages;

use App\Filament\Driver\Resources\DriverResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDriver extends CreateRecord
{

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_admin'] = 1;
     
        return $data;
    }
    protected static string $resource = DriverResource::class;
}
