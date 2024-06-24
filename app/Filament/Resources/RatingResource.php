<?php

namespace App\Filament\Resources;
use Mokhosh\FilamentRating\Components\Rating as RatingComponent;
use Mokhosh\FilamentRating\Columns\RatingColumn;
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

    protected static ?string $navigationIcon = 'heroicon-s-star';
    protected static ?string $label = 'Calificaciones';
    protected static ?string $navigationGroup = 'Viajes';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('id_driver')
                ->relationship(name: 'driver', titleAttribute: 'document')
                ->label('Conductor')
                ->placeholder('Seleccione la cedula del conductor')
                ->required(),
            Forms\Components\Select::make('id_customer')
                ->relationship(name: 'customers', titleAttribute: 'document')
                ->label('Cliente')
                ->placeholder('Seleccione la cedula del cliente')
                ->required(),
            Forms\Components\Select::make('id_route')
                ->relationship(name: 'route', titleAttribute: 'location')
                ->label('Ruta')
                ->placeholder('Seleccione la ruta realizada')
                ->required(),
            RatingComponent::make('ratings') // Utiliza RatingComponent::make() aquí
                ->label('Calificación'),
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
                RatingColumn::make('ratings')
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
