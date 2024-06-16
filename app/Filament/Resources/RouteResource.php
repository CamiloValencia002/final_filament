<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RouteResource\Pages;
use App\Filament\Resources\RouteResource\RelationManagers;
use App\Models\Route;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RouteResource extends Resource
{
    protected static ?string $model = Route::class;

    protected static ?string $navigationIcon = 'heroicon-s-map';
    protected static ?string $label = 'Rutas';
    protected static ?string $navigationGroup = 'Viajes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_driver')
                ->relationship(name: 'driver', titleAttribute: 'document',) // el title sirve para mostrar el campo de la bd
                ->label('Conductor')
                ->placeholder('Seleccione la cedula del conductor')
                ->required(),
                Forms\Components\Select::make('id_package')
                ->relationship(name: 'package', titleAttribute: 'carge_type',) // el title sirve para mostrar el campo de la bd
                ->label('Paquete')
                ->placeholder('Seleccione la carga del paquete')
                ->required(),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->placeholder('Especifica la ruta realizada')
                    ->label('Ubicacion')
                    ->maxLength(255),
                Forms\Components\TextInput::make('comment')
                    ->maxLength(255)
                    ->label('Comentario'),
                    Select::make('state')
                    ->required()
                    ->placeholder('Estado')
                    ->label('Estado')
                    ->options([
                        'BUSCANDO' => 'BUSCANDO',
                        'ACEPTADO' => 'ACEPTADO',
                        'EN PROCESO' => 'EN PROCESO',
                        'COMPLETADO' => 'COMPLETADO',
                        'CANCELADO' => 'CANCELADO',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('driver.document')
                ->label('Cedula del Conductor')
                ->searchable(),
                Tables\Columns\TextColumn::make('package.carge_type')
                ->label('Carga del Paquete')
                ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
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
            'index' => Pages\ListRoutes::route('/'),
            'create' => Pages\CreateRoute::route('/create'),
            'edit' => Pages\EditRoute::route('/{record}/edit'),
        ];
    }
}
