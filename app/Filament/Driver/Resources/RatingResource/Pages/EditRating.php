<?php

namespace App\Filament\Driver\Resources\RatingResource\Pages;

use App\Filament\Driver\Resources\RatingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRating extends EditRecord
{
    protected static string $resource = RatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
