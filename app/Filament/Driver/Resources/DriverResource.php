<?php

namespace App\Filament\Driver\Resources;

use App\Filament\Driver\Resources\DriverResource\Pages;
use App\Filament\Driver\Resources\DriverResource\RelationManagers;
use App\Models\Driver;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Label;

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->where('id', Auth::user()->id);
}

public static function canCreate(): bool
{
    return false;
}
protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('adress')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->maxLength(255),
                Forms\Components\TextInput::make('document')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('document_verify')
                ->required()
                ->disabled(),
                Forms\Components\FileUpload::make('photo_licence')
                    ->image(),
                    Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->label('Foto de perfil'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('adress')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document')
                    ->searchable(),
                Tables\Columns\IconColumn::make('document_verify')
                    ->boolean(),
                Tables\Columns\TextColumn::make('photo_licence')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ratings')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListDrivers::route('/'),
            // 'create' => Pages\CreateDriver::route('/create'),
            'edit' => Pages\EditDriver::route('/{record}/edit'),
        ];
    }
}
