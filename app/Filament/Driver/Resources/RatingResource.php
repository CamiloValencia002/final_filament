<?php

namespace App\Filament\Driver\Resources;

use Mokhosh\FilamentRating\Components\Rating as ratings;

use App\Filament\Driver\Resources\RatingResource\Pages;
use App\Models\Rating;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;
use Mokhosh\FilamentRating\Columns\RatingColumn;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Mis Calificaciones';

    


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('id_driver')
                    ->default(Auth::id()),
                Forms\Components\Hidden::make('id_customer'),
                Forms\Components\Hidden::make('id_package'),
                Ratings::make('ratings')
                    ->required()
                    ->min(1)
                    ->max(5),
                Forms\Components\Textarea::make('comment')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.carge_type')
                    ->label('Tipo de Carga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.point_initial')
                    ->label('Punto Inicial')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.point_finally')
                    ->label('Punto Final')
                    ->searchable(),
                    RatingColumn::make('ratings')
                    ->label('Calificación'),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Comentario'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('calificar')
                    ->label('Calificar')
                    ->icon('heroicon-o-star')
                    ->form([
                        ratings::make('ratings')
                            ->required(),
                        Forms\Components\Textarea::make('comment')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->action(function (Rating $record, array $data) {
                        $record->update([
                            'ratings' => $data['ratings'],
                            'comment' => $data['comment'],
                        ]);
                    })
                    ->visible(fn (Rating $record): bool => is_null($record->ratings))
                    ->modalHeading('Calificar Servicio')
                    ->modalButton('Enviar Calificación'),
                
                Action::make('ver_detalles')
                    ->label('Ver Detalles')
                    ->icon('heroicon-o-eye')
                    ->modalContent(fn (Rating $record) => view('filament.driver.resources.rating-resource.view-details', [
                        'package' => $record->package,
                        'customer' => $record->package->customers,
                    ])),
            ])
            ->bulkActions([
                // No bulk actions needed
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('id_driver', Auth::id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
        ];
    }
}