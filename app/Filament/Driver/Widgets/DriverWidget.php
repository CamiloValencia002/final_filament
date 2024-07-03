<?php

namespace App\Filament\Driver\Widgets;

use App\Models\Driver;
use App\Models\Package;
use App\Models\Rating;
use App\Models\Vehicle;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DriverWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $driverId = Auth::id();

        $driverCount = Rating::where('id_driver', $driverId)->count();
        $total = Package::where('id_driver', $driverId)
            ->sum('price');

        $formattedTotal = number_format($total, 3, '.', ',');

        $vehicles = Vehicle::where('id_driver', $driverId)->count();

        $freePackages = Package::where('state', 'LIBRE')->count();

        return [
            Stat::make(
                'Tus Viajes Completados',
                $driverCount
            )
                ->description('Aquí encontrarás todos tus viajes')
                ->descriptionIcon('heroicon-m-magnifying-glass-plus', IconPosition::Before)
                ->color('success')
                ->chart([0, 5, 10, 30, 60]),

            Stat::make(
                'Tus Ganancias',
                "$" . $formattedTotal
            )
                ->description('Aquí encontrarás todas tus ganancias')
                ->descriptionIcon('heroicon-s-currency-dollar', IconPosition::Before)
                ->color('primary')
                ->chart([0, 5, 10, 30, 60]),

            Stat::make(
                'Tus Vehículos',
                $vehicles
            )
                ->description('Aquí encontrarás tus vehículos registrados')
                ->descriptionIcon('heroicon-o-truck', IconPosition::Before)
                ->color('info')
                ->chart([0, 5, 10, 30, 60]),

            Stat::make(
                'Paquetes Disponibles',
                $freePackages
            )
                ->description('Paquetes en estado "LIBRE"')
                ->descriptionIcon('heroicon-o-truck', IconPosition::Before)
                ->color('danger')
                ->chart([0, 5, 10, 30, 60]),
        ];
    }
}