<?php

namespace App\Filament\Driver\Resources\PackageResource\Pages;

use App\Filament\Driver\Resources\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePackage extends CreateRecord
{

    protected function mutateFormDataBeforeCreate(array $data): array
{
    if ($data['state'] === 'OCUPADO') {
        $data['id_driver'] = Auth::user()->id;
    } else {
        $data['id_driver'] = null;
    }
    return $data;
}
    protected static string $resource = PackageResource::class;
}
