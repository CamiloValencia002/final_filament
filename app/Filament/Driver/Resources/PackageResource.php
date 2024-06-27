<?php

namespace App\Filament\Driver\Resources;

use App\Filament\Driver\Resources\PackageResource\Pages;
use App\Filament\Driver\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('state', 'LIBRE');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_customer')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('carge_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('size')
                    ->maxLength(255),
                Forms\Components\TextInput::make('weight')
                    ->maxLength(255),
                Forms\Components\TextInput::make('point_initial')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('point_finally')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('comment')
                    ->maxLength(255),

                    
                    Forms\Components\Hidden::make('id_driver'),
                    Select::make('state')
                        ->required()
                        ->placeholder('Estado')
                        ->label('Estado')
                        ->options([
                            'LIBRE' => 'LIBRE',
                            'OCUPADO' => 'OCUPADO',
                        ]), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_customer')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('carge_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('size')
                    ->searchable(),
                Tables\Columns\TextColumn::make('weight')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point_initial')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point_finally')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->searchable(),

                    Tables\Columns\TextColumn::make('state')
                    ->label('Estado')
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
