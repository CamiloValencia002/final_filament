<?php

    namespace App\Filament\Driver\Resources;

    use App\Filament\Driver\Resources\VehicleResource\Pages;
    use App\Models\Vehicle;
    use Filament\Forms;
    use Filament\Forms\Components\FileUpload;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\ImageColumn;
    use Filament\Tables\Table;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Facades\Auth;

    class VehicleResource extends Resource
    {
        protected static ?string $model = Vehicle::class;
        protected static ?string $navigationIcon = 'heroicon-o-truck';
        protected static ?string $modelLabel = 'Vehículo';
        protected static ?string $pluralModelLabel = 'Vehículos';
        protected static ?int $sort = 5;
        protected static ?int $navigationSort = 5;

        public static function getEloquentQuery(): Builder
        {
            return parent::getEloquentQuery()->where('id_driver', Auth::id());
        }

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\Card::make()
                        ->schema([
                            // Información básica del vehículo
                            Forms\Components\Section::make('Información del vehículo')
                                ->schema([
                                    Forms\Components\Select::make('type')
                                        ->required()
                                        ->label('Tipo')
                                        ->placeholder('Seleccione el tipo de vehículo')
                                        ->options([
                                            'Camión' => 'Camión',
                                            'Furgoneta' => 'Furgoneta',
                                            'Camioneta' => 'Camioneta',
                                            'Otro' => 'Otro',
                                        ]),
                                    Forms\Components\TextInput::make('capacity')
                                        ->required()
                                        ->label('Capacidad')
                                        ->placeholder('Ej: 1000 kg')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('dimension')
                                        ->required()
                                        ->label('Dimensiones')
                                        ->placeholder('Ej: 2m x 3m x 1.5m')
                                        ->maxLength(255),
                                ])
                                ->columns(2),
        
                            // Documentación
                            Forms\Components\Section::make('Documentación')
                                ->schema([
                                    Forms\Components\Toggle::make('photo_soat')
                                        ->label('SOAT')
                                        ->required(),
                                    Forms\Components\Toggle::make('photo_tecnomecanic')
                                        ->label('Tecnicomecánica')
                                        ->required(),
                                ])
                                ->columns(2),
        
                            // Foto del vehículo
                            Forms\Components\Section::make('Foto del vehículo')
                                ->schema([
                                    FileUpload::make('vehicle_photo')
                                        ->label('Imagen del vehículo')
                                        ->image()
                                        ->imageEditor()
                                        ->directory('vehicles')
                                        ->visibility('public')
                                        ->columnSpan(2),
                                ]),
                        ])
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    ImageColumn::make('vehicle_photo')
                        ->label('Foto del vehículo')
                        ->circular(),
                    Tables\Columns\TextColumn::make('capacity')
                        ->placeholder('')
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
                        ->label('Tecnicomecánica')
                        ->boolean(),
                ])
                ->filters([
                    //
                ])
                ->actions([
                    // No actions
                ])
                ->bulkActions([
                    // No bulk actions
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
            ];
        }
    }