<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DriverResource\Pages;
use App\Filament\Resources\DriverResource\RelationManagers;
use App\Models\Driver;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $label = 'Conductores';
    protected static ?string $navigationGroup = 'Conductores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_admin')
                    ->relationship(name: 'user', titleAttribute: 'name',) // el title sirve para mostrar el campo de la bd
                    ->label('Administrado')
                    ->placeholder('Seleccione un administrador')
                    ->required(),


                FileUpload::make('image')
                    ->label('Foto de perfil')
                    ->image() // Indica que se trata de una imagen
                    ->imageEditor()
                    ->directory('drivers') // Directorio donde se guardarán las imágenes
                    ->visibility('public'), // Hacer las imágenes públicas

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nombre')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->label('Apellido')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Correo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->required()
                    ->label('Telefono')
                    ->maxLength(255),
                Forms\Components\TextInput::make('adress')
                    ->required()
                    ->label('Direccion')
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->label('Contraseña')
                    ->required()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
                Forms\Components\TextInput::make('document')
                    ->required()
                    ->label('Documento')
                    ->maxLength(255),
                Forms\Components\Toggle::make('document_verify')
                    ->label('Verificacion del Documento')
                    ->required(),

                FileUpload::make('photo_licence')
                    ->label('Licencia de conducción')
                    ->image()
                    ->imageEditor()
                    ->directory('drivers') 
                    ->visibility('public'), 

                    Forms\Components\Select::make('role')
                    ->relationship(name: 'role', titleAttribute: 'name',)
                    ->label('Rol')
                    ->placeholder('Seleccione un rol')
                    ->required(),
                Forms\Components\TextInput::make('ratings')
                    ->required()
                    ->label('Calificacion') 
                    ->numeric()
                    ->readOnly()
                    ->default(0),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Administrador')
                    ->searchable(),

                    ImageColumn::make('image')
                    ->label('Foto de perfil')
                    ->visibility('public')
                    ->circular(), // Forma circular de la imagen
    
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->label('Telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('adress')
                    ->label('Direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document')
                    ->searchable()
                    ->label('Documento'),
                Tables\Columns\IconColumn::make('document_verify')
                    ->boolean()
                    ->label('Verificacion Documento'),
                Tables\Columns\TextColumn::make('photo_licence')
                    ->searchable()
                    ->label('Foto Licencia'),
                Tables\Columns\TextColumn::make('ratings')
                    ->numeric()
                    ->label('Calificacion')
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
            'index' => Pages\ListDrivers::route('/'),
            'create' => Pages\CreateDriver::route('/create'),
            'edit' => Pages\EditDriver::route('/{record}/edit'),
        ];
    }
}
