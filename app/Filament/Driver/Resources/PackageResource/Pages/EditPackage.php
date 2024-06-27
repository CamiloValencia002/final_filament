<?php

namespace App\Filament\Driver\Resources\PackageResource\Pages;

use App\Filament\Driver\Resources\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditPackage extends EditRecord
{
    protected static string $resource = PackageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['state'] === 'OCUPADO') {
            $data['id_driver'] = Auth::user()->id;
        } else {
            $data['id_driver'] = null;
        }
        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
