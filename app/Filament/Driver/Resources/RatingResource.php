<?php

namespace App\Filament\Driver\Resources;

use Mokhosh\FilamentRating\Components\Rating as RatingInput;
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
use Filament\Tables\Filters\SelectFilter;
use Mokhosh\FilamentRating\Columns\RatingColumn;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Mis Calificaciones';
    protected static ?string $modelLabel = 'Calificación';
    protected static ?string $pluralModelLabel = 'Calificaciones';
    protected static ?int $sort = 4;
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('id_driver')
                    ->default(Auth::id()),
                Forms\Components\Hidden::make('id_customer'),
                Forms\Components\Hidden::make('id_package'),
                RatingInput::make('ratings')
                    ->label('Calificación')
                    ->required()
                    ->min(1)
                    ->max(5),
                Forms\Components\Textarea::make('comment')
                    ->label('Comentario')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.id')
                ->label('ID del paquete')
                ->searchable(),
                Tables\Columns\TextColumn::make('package.carge_type')
                    ->label('Tipo de Carga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.point_initial')
                    ->label('Punto Inicial')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.point_finally')
                    ->label('Punto Final')
                    ->searchable(),
                RatingColumn::make('rating_driver')
                    ->label('Mi calificación'),
                Tables\Columns\TextColumn::make('comment_driver')
                    ->label('Mi comentario')
                    ->limit(30),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
            ])
            ->actions([
                Action::make('ver_detalles')
                    ->label('Ver Detalles')
                    ->icon('heroicon-o-eye')
                    ->button()
                    ->color('info')
                    ->modalContent(fn (Rating $record) => view('filament.driver.resources.rating-resource.view-details', [
                        'package' => $record->package,
                        'customer' => $record->package->customers,
                    ]))
                    ->modalHeading('Detalles del Servicio'),
                Action::make('calificar')
                    ->label('Calificar cliente')
                    ->icon('heroicon-o-star')
                    ->button()
                    ->color('warning')
                    ->form([
                        RatingInput::make('rating_driver')
                            ->label('Calificar cliente')
                            ->required(),
                        Forms\Components\Textarea::make('comment_driver')
                            ->label('Comentario (opcional)')
                            ->maxLength(255),
                    ])
                    ->action(function (Rating $record, array $data) {
                        $record->update([
                            'rating_driver' => $data['rating_driver'],
                            'comment_driver' => $data['comment_driver'],
                        ]);
                    })
                    ->visible(fn (Rating $record): bool => is_null($record->rating_driver))
                    ->modalHeading('Calificar cliente')
                    ->modalSubmitActionLabel('Enviar Calificación')
                    ->modalCancelActionLabel('Cancelar'),

                
            ])
            ->bulkActions([]);
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

    public static function canCreate(): bool
    {
        return false;
    }
}