<?php

namespace App\Filament\Driver\Resources;

use App\Filament\Driver\Resources\PackageResource\Pages;
use App\Models\Package;
use App\Models\Rating;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action as TableAction;
use Illuminate\Support\Facades\Log;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Paquete';
    protected static ?string $pluralModelLabel = 'Paquetes';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('state', 'LIBRE');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_customer')
                    ->label('ID del Cliente')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('carge_type')
                    ->label('Tipo de Carga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('size')
                    ->label('Tamaño')
                    ->maxLength(255),
                Forms\Components\TextInput::make('weight')
                    ->label('Peso')
                    ->maxLength(255),
                Forms\Components\TextInput::make('point_initial')
                    ->label('Punto de Inicio')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('point_finally')
                    ->label('Punto Final')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Descripción')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Precio')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('comment')
                    ->label('Comentario')
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
                    ->label('ID del Cliente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('carge_type')
                    ->label('Tipo de Carga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('size')
                    ->label('Tamaño')
                    ->searchable(),
                Tables\Columns\TextColumn::make('weight')
                    ->label('Peso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point_initial')
                    ->label('Punto de Inicio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point_finally')
                    ->label('Punto Final')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Comentario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->label('Estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('state')
                    ->label('Estado')
                    ->options([
                        'LIBRE' => 'LIBRE',
                        'OCUPADO' => 'OCUPADO',
                    ])
                    ->default('LIBRE'),
            ])
            ->actions([
                TableAction::make('tomar_pedido')
                    ->label('Tomar Pedido')
                    ->icon('heroicon-o-truck')
                    ->button()
                    ->color('success')
                    ->hidden(fn ($record) => $record->state !== 'LIBRE')
                    ->action(function (Package $record) {
                        $hasVehicle = Vehicle::where('id_driver', Auth::id())->exists();
                        if (!$hasVehicle) {
                            Notification::make()
                                ->title('No tienes un vehículo registrado')
                                ->body('Debes registrar un vehículo antes de poder tomar pedidos.')
                                ->danger()
                                ->duration(5000) // Duración de 5 segundos
                                ->send();
                            return;
                        }
                        try {
                            $record->update([
                                'id_driver' => Auth::id(),
                                'state' => 'OCUPADO'
                            ]);

                            $rating = Rating::create([
                                'id_driver' => Auth::id(),
                                'id_customer' => $record->id_customer,
                                'id_package' => $record->id,
                                'ratings' => null,
                                'comment' => null,
                            ]);

                            Log::info('Nuevo rating creado', [
                                'rating_id' => $rating->id,
                                'package_id' => $record->id,
                                'driver_id' => Auth::id(),
                                'customer_id' => $record->id_customer,
                            ]);

                            // Notificación de pedido tomado
                            Notification::make()
                                ->title('Pedido Tomado')
                                ->body('Has tomado el pedido exitosamente.')
                                ->success()
                                ->duration(10000)
                                ->send();

                            // Notificación para calificar el viaje
                            Notification::make()
                                ->title('No olvides calificar el viaje')
                                ->body('Cuando termines el viaje, recuerda calificarlo.')
                                ->actions([
                                    \Filament\Notifications\Actions\Action::make('calificar')
                                        ->label('Ir a Calificaciones')
                                        ->url(route('filament.driver.resources.ratings.index'))
                                        ->button(),
                                ])
                                ->warning()
                                ->duration(10000)
                                ->send();
                        } catch (\Exception $e) {
                            Log::error('Error al crear rating', [
                                'error' => $e->getMessage(),
                                'package_id' => $record->id,
                            ]);
                            throw $e;
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('¿Estás seguro de tomar este pedido?')
                    ->modalDescription('Una vez tomado, no podrás devolverlo.')
                    ->modalSubmitActionLabel('Sí, tomar pedido')
                    ->modalCancelActionLabel('Cancelar'),

                TableAction::make('ver_solicitud')
                    ->label('Ver Detalles')
                    ->icon('heroicon-o-eye')
                    ->button()
                    ->color('info')
                    ->modalHeading('Detalles del Paquete y Cliente')
                    ->modalContent(function (Package $record) {
                        $customer = $record->customers;
                        return view('filament.driver.resources.package-resource.view-solicitud', [
                            'package' => $record,
                            'customer' => $customer,
                        ]);
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
