<?php

namespace App\Filament\Driver\Widgets;

use App\Models\Driver;
use App\Models\Package;
use App\Models\Rating;
use App\Models\Vehicle;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class DriverWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $driverId = Auth::id();

        $driverCount = Rating::where('id_driver', $driverId)->count();
        $total = Package::where('id_driver', $driverId)->sum('price');

        $formattedTotal = number_format($total, 2, '.', ',');

        $vehicles = Vehicle::where('id_driver', $driverId)->count();

        $averageRating = Rating::where('id_driver', $driverId)->avg('rating_customer');
        $averageRating = round($averageRating, 2);

        $freePackages = Package::where('state', 'LIBRE')->count();

        $currentDate = Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY');
        $city = 'Pereira';

        return [
            Stat::make('Fecha y Ciudad', new HtmlString($this->generateDateCityHtml($currentDate, $city)))
                ->description('Información actual')
                ->descriptionIcon('heroicon-o-calendar', IconPosition::Before)
                ->color('danger'),
                
            Stat::make('Tus calificaciones', new HtmlString($this->generateStars($averageRating)))
                ->description('Aquí encontrarás tu promedio de calificaciones: ' . $averageRating)
                ->descriptionIcon('heroicon-o-star', IconPosition::Before)
                ->color('warning')
                ->chart([
                    max(0, $averageRating - 0.5), 
                    max(0, $averageRating - 0.25), 
                    $averageRating, 
                    min(5, $averageRating + 0.25), 
                    min(5, $averageRating + 0.5)
                ]),

            Stat::make('Tus Viajes Completados', $driverCount)
                ->description('Aquí encontrarás todos tus viajes')
                ->descriptionIcon('heroicon-m-magnifying-glass-plus', IconPosition::Before)
                ->color('success')
                ->chart([0, 5, 10, 30, 60]),

            Stat::make('Tus Ganancias', "$" . $formattedTotal)
                ->description('Aquí encontrarás todas tus ganancias')
                ->descriptionIcon('heroicon-s-currency-dollar', IconPosition::Before)
                ->color('primary')
                ->chart([0, 5, 10, 30, 60]),

            Stat::make('Tus Vehículos', $vehicles)
                ->description('Aquí encontrarás tus vehículos registrados')
                ->descriptionIcon('heroicon-o-truck', IconPosition::Before)
                ->color('info')
                ->chart([0, 5, 10, 30, 60]),

            Stat::make('Paquetes Disponibles', $freePackages)
                ->description('Paquetes en estado "LIBRE"')
                ->descriptionIcon('heroicon-o-truck', IconPosition::Before)
                ->color('danger')
                ->chart([0, 5, 10, 30, 60]),
        ];
    }

    protected function generateStars($rating)
    {
        $fullStar = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-400 inline">
          <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
        </svg>';
        $emptyStar = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-400 inline">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
        </svg>';

        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= $fullStar;
            } else {
                $stars .= $emptyStar;
            }
        }

        return $stars;
    }

    protected function generateDateCityHtml($date, $city)
    {
        return "
            <div class='text-lg font-medium text-gray-900'>$date</div>
            <div class='mt-1 text-sm text-gray-500'>$city</div>
        ";
    }
}