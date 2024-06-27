<?php

namespace App\Filament\Resources\PackageResource\Pages;

use App\Filament\Resources\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePackage extends CreateRecord
{


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_driver'] = 1;
     
        return $data;
    }
    protected static string $resource = PackageResource::class;
}
