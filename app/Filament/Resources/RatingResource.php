<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatingResource\Pages;
use App\Filament\Resources\RatingResource\RelationManagers;
use App\Models\Rating;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $label = 'Calificaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_driver')
                    ->relationship(name: 'driver', titleAttribute: 'document',) // el title sirve para mostrar el campo de la bd
                    ->label('Conductor')
                    ->placeholder('Seleccione la cedula del conductor')
                    ->required(),
                Forms\Components\Select::make('id_customer')
                    ->relationship(name: 'customers', titleAttribute: 'document',) // el title sirve para mostrar el campo de la bd
                    ->label('Cliente')
                    ->placeholder('Seleccione la cedula del cliente')
                    ->required(),
                    Forms\Components\Select::make('id_route')
                    ->relationship(name: 'route', titleAttribute: 'location',) // el title sirve para mostrar el campo de la bd
                    ->label('Ruta')
                    ->placeholder('Seleccione la ruta realizada')
                    ->required(),
                    Select::make('ratings')
                    ->required()
                    ->placeholder('Califica Tu Experiencia')
                    ->label('Calificaciones')
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                    ]),
                Forms\Components\TextInput::make('comment')
                    ->required()
                    ->label('Comentario')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('driver.document')
                ->label('Cedula del Conductor')
                ->searchable(),
                Tables\Columns\TextColumn::make('customers.document')
                ->label('Cedula del Cliente')
                ->searchable(),
                Tables\Columns\TextColumn::make('route.location')
                ->label('Ruta')
                ->searchable(),
                Tables\Columns\TextColumn::make('ratings')
                    ->numeric()
                    ->label('Calificacion')
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->searchable()
                    ->label('Comentario'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
