<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-s-truck';
    protected static ?string $label = 'Vehiculos';
    protected static ?string $navigationGroup = 'Conductores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_driver')
                    ->relationship(name: 'driver', titleAttribute: 'document') // el title sirve para mostrar el campo de la bd
                    ->label('Conductor')
                    ->placeholder('Seleccione la cedúla del conductor')
                    ->required(),
                    FileUpload::make('vehicle_photo')
                    ->label('Imagen del vehículo')
                    ->image() // Indica que se trata de una imagen
                    ->imageEditor()
                    ->directory('vehicles') // Directorio donde se guardarán las imágenes
                    ->visibility('public'), // Hacer las imágenes públicas

                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->label('Capacidad')
                    ->maxLength(255),
                Forms\Components\TextInput::make('dimension')
                    ->required()
                    ->label('Dimensiones')
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->label('Tipo')
                    ->maxLength(255),
                Forms\Components\Toggle::make('photo_soat')
                    ->label('SOAT')
                    ->required(),
                Forms\Components\Toggle::make('photo_tecnomecanic')
                    ->label('TECNICOMECANICA')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('driver.document')->label('Conductor')
                ->searchable(),

                ImageColumn::make('vehicle_photo')
                ->label('Foto del vehículo')
                ->visibility('public')
                ->circular(), // Forma circular de la imagen
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Capacidad')

                    ->searchable(),
                Tables\Columns\TextColumn::make('dimension')
                    ->label('Dimensiones')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')

                    ->searchable(),
                Tables\Columns\IconColumn::make('photo_soat')
                    ->label('SOAT')
                    ->boolean(),
                Tables\Columns\IconColumn::make('photo_tecnomecanic')
                    ->label('TECNICOMECANICA')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')

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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
