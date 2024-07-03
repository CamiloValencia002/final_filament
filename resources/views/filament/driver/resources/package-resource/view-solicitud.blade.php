<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-header bg-primary">
                    <h3 class="mb-0">Información del Paquete</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Tipo de Carga:</span>
                            <span>{{ $package->carge_type }}</span>
                        </li>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Tamaño:</span>
                            <span>{{ $package->size }}</span>
                        </li>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Peso:</span>
                            <span>{{ $package->weight }}</span>
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            <span class="font-weight-bold">Punto Inicial:</span>
                            <p class="mb-1">{{ $package->point_initial }}</p>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($package->point_initial) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-info">
                                <i class="fas fa-map-marker-alt"></i> Ver en mapa
                            </a>
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            <span class="font-weight-bold">Punto Final:</span>
                            <p class="mb-1">{{ $package->point_finally }}</p>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($package->point_finally) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-info">
                                <i class="fas fa-map-marker-alt"></i> Ver en mapa
                            </a>
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            <span class="font-weight-bold">Descripción:</span>
                            <p>{{ $package->description }}</p>
                        </li>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Precio:</span>
                            <span class="badge badge-success">${{ number_format($package->price, 2) }}</span>
                        </li>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Estado:</span>
                            <span class="badge badge-warning">{{ $package->state }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-header bg-success">
                    <h3 class="mb-0">Información del Cliente</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Nombre:</span>
                            <span>{{ $customer->name }}</span>
                        </li>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Documento:</span>
                            <span>{{ $customer->document }}</span>
                        </li>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Teléfono:</span>
                            <a href="tel:{{ $customer->phone }}" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-phone"></i> {{ $customer->phone }}
                            </a>
                        </li>
                        <li class="list-group-item bg-dark text-white">
                            <span class="font-weight-bold">Dirección:</span>
                            <p>{{ $customer->address }}</p>
                        </li>
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Correo:</span>
                            <a href="mailto:{{ $customer->email }}" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-envelope"></i> {{ $customer->email }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>