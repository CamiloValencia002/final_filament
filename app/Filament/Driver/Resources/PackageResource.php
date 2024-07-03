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
    protected static ?int $sort = 2;
    protected static ?int $navigationSort = 2;
    protected static ?string $pluralModelLabel = 'Paquetes';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('state', 'LIBRE');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              
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
                                'state' => 'EN PROCESO'
                            ]);


                            // Notificación de pedido tomado
                            Notification::make()
                                ->title('Pedido Tomado')
                                ->body('Has tomado el pedido exitosamente.')
                                ->actions([
                                    \Filament\Notifications\Actions\Action::make('Mi viaje')
                                        ->label('Ir a mis viajes')
                                        ->url(route('filament.driver.resources.my-trips.index'))
                                        ->button(),
                                ])
                                ->success()
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
