<div class="space-y-4">
    <h3 class="text-lg font-medium">Información del Paquete</h3>
    <div class="grid grid-cols-2 gap-4">
        <div><strong>Tipo de Carga:</strong> {{ $package->carge_type }}</div>
        <div><strong>Tamaño:</strong> {{ $package->size }}</div>
        <div><strong>Peso:</strong> {{ $package->weight }}</div>
        <div><strong>Punto Inicial:</strong> {{ $package->point_initial }}</div>
        <div><strong>Punto Final:</strong> {{ $package->point_finally }}</div>
        <div><strong>Descripción:</strong> {{ $package->description }}</div>
        <div><strong>Precio:</strong> ${{ number_format($package->price, 2) }}</div>
        <div><strong>Estado:</strong> {{ $package->state }}</div>
    </div>

    {{-- <h4 class="text-lg font-medium mt-6">Información del Cliente</h4>
    <div class="grid grid-cols-2 gap-4">
        <div><strong>Nombre:</strong> {{ $customer->name }}</div>
        <div><strong>Documento:</strong> {{ $customer->document }}</div>
        <div><strong>Teléfono:</strong> {{ $customer->phone }}</div>
        <div><strong>Dirección:</strong> {{ $customer->address }}</div>
        <div><strong>Correo:</strong> {{ $customer->email }}</div>
    </div> --}}
</div>