<?php

namespace App\Filament\Driver\Resources;

use App\Filament\Driver\Resources\MyTripsResource\Pages;
use App\Filament\Driver\Resources\MyTripsResource\RelationManagers;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action as TableAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MyTripsResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-s-globe-europe-africa';

    protected static ?string $modelLabel = 'Mi viaje';
    protected static ?string $pluralModelLabel = 'Mis viajes';
    protected static ?int $sort = 3;
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
        ->where('state', 'EN PROCESO')
        ->where('id_driver', Auth::id());
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
             
                Tables\Columns\TextColumn::make('carge_type')
                    ->label('Tipo de Carga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point_initial')
                    ->label('Punto de Inicio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point_finally')
                    ->label('Punto Final')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Comentario')
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
                TableAction::make('finalizar_pedido')
                ->label('Terminar entrega')
                ->icon('heroicon-o-check-circle')
                ->button()
                ->color('success')
                ->hidden(fn ($record) => $record->state !== 'EN PROCESO' || $record->id_driver !== Auth::id())
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
                                'state' => 'FINALIZADO'
                            ]);

                            $rating = Rating::create([
                                'id_driver' => Auth::id(),
                                'id_customer' => $record->id_customer,
                                'id_package' => $record->id,
                            ]);

                            Log::info('Nuevo rating creado', [
                                'rating_id' => $rating->id,
                                'package_id' => $record->id,
                                'driver_id' => Auth::id(),
                                'customer_id' => $record->id_customer,
                            ]);

                            // Notificación de pedido tomado
                            Notification::make()
                                ->title('Pedido finalizado')
                                ->body('Has finalizado el pedido exitosamente.')
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
                    ->modalHeading('¿Estás seguro de finalizar este pedido?')
                    ->modalDescription('Una vez finalizado, no podrás revertir esta acción.')
                    ->modalSubmitActionLabel('Sí, finalizar pedido')
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
            'index' => Pages\ListMyTrips::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
