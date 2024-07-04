
<style>
    .map-button {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        margin-top: 5px;
    }
    .map-button:hover {
        opacity: 0.8;
    }
    .start-button {
        background-color: #4CAF50;
    }
    .end-button {
        background-color: #F44336;
    }
</style>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Información del Cliente -->
    <div class="bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-white">
                Información del Cliente
            </h3>
        </div>
        <div class="border-t border-gray-700">
            <table class="min-w-full divide-y divide-gray-700">
                <tbody class="bg-gray-900 divide-y divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Nombre</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Documento</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $customer->document }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Teléfono</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            <a href="tel:{{ $customer->telephone }}" class="text-blue-400 hover:text-blue-300">
                                {{ $customer->telephone }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Dirección</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">{{ $customer->adress }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Correo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            <a href="mailto:{{ $customer->email }}" class="text-blue-400 hover:text-blue-300">
                                {{ $customer->email }}
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Información del Paquete -->
    <div class="bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-white">
                Información del Paquete
            </h3>
        </div>
        <div class="border-t border-gray-700">
            <table class="min-w-full divide-y divide-gray-700">
                <tbody class="bg-gray-900 divide-y divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Tipo de Carga</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">
                            {{ $package->carge_type }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Tamaño</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">
                            {{ $package->size }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Peso</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">
                            {{ $package->weight }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Comentario</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">
                            {{ $package->comment }}
                        </td>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Punto Inicial</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">
                            {{ $package->point_initial }}
                            <br>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($package->point_initial) }}"
                               target="_blank"
                               class="map-button start-button">
                                M
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Punto Final</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">
                            {{ $package->point_finally }}
                            <br>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($package->point_finally) }}"
                               target="_blank"
                               class="map-button end-button">
                                M
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Descripción</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-white">{{ $package->description }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Precio</td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg text-white border-b-2 border-white">${{ number_format($package->price, 2) }}</td>
                    </tr>
                    
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">Estado</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                {{ $package->state }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>