<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-group';
    protected static ?string $label = 'Clientes';
    protected static ?string $navigationGroup = 'Clientes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_admin')
                    ->relationship(name: 'user', titleAttribute: 'name',) // el title sirve para mostrar el campo de la bd
                    ->label('Administrado')
                    ->placeholder('Seleccione un administrador')
                    ->required(),
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
                    ->label('Correo')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->label('Contraseña')
                    ->required()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->label('Telefono')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('adress')
                    ->required()
                    ->label('Direccion')
                    ->maxLength(255),
                Forms\Components\TextInput::make('document')
                    ->required()
                    ->label('Documento')
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('Imagen de perfil')
                    ->image() 
                    ->imageEditor()
                    ->directory('customers') 
                    ->visibility('public'), 
                Forms\Components\Toggle::make('document_verify')
                    ->required()
                    ->label('Verificacion Documento'),
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
                    ->searchable()
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->label('Apellido'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Correo'),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable()
                    ->label('Telefono'),
                Tables\Columns\TextColumn::make('adress')
                    ->searchable()
                    ->label('Direccion'),
                Tables\Columns\TextColumn::make('document')
                    ->searchable()
                    ->label('Documento'),
                Tables\Columns\IconColumn::make('document_verify')
                    ->boolean()
                    ->label('Verificacion Documento'),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
