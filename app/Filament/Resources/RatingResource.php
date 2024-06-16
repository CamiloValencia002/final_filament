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
                Forms\Components\TextInput::make('id_driver')
                    ->required()
                    ->label('Conductor')
                    ->numeric(),
                Forms\Components\TextInput::make('id_customer')
                    ->required()
                    ->label('Cliente')
                    ->numeric(),
                Forms\Components\TextInput::make('id_route')
                    ->required()
                    ->label('Ruta')
                    ->numeric(),
                Forms\Components\TextInput::make('ratings')
                    ->required()
                    ->label('Calificaciones')
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('id_driver')
                    ->numeric()
                    ->label('Conductor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_customer')
                    ->numeric()
                    ->label('Cliente')
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_route')
                    ->numeric()
                    ->label('Ruta')
                    ->sortable(),
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
