<div class="p-4 bg-black rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Detalles del Servicio</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <h3 class="text-lg font-semibold mb-2">Información del Paquete</h3>
            <p><span class="font-medium">Tipo de Carga:</span> {{ $package->carge_type }}</p>
            <p><span class="font-medium">Tamaño:</span> {{ $package->size }}</p>
            <p><span class="font-medium">Peso:</span> {{ $package->weight }}</p>
            <p><span class="font-medium">Punto Inicial:</span> {{ $package->point_initial }}</p>
            <p><span class="font-medium">Punto Final:</span> {{ $package->point_finally }}</p>
            <p><span class="font-medium">Descripción:</span> {{ $package->description }}</p>
            <p><span class="font-medium">Precio:</span> ${{ number_format($package->price, 2) }}</p>
        </div>
        
        <div>
            <h3 class="text-lg font-semibold mb-2">Información del Cliente</h3>
            <p><span class="font-medium">Nombre:</span> {{ $customer->name }}</p>
            <p><span class="font-medium">Email:</span> {{ $customer->email }}</p>
            <p><span class="font-medium">Teléfono:</span> {{ $customer->phone }}</p>
        </div>
    </div>
</div>