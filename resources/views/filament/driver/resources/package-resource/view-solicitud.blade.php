<div class="space-y-6 p-6 bg-gray-900 rounded-lg">
    <div class="bg-black shadow rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-gray-800">
            <h3 class="text-lg leading-6 font-medium text-white">
                Información del Paquete
            </h3>
        </div>
        <div class="border-t border-gray-700">
            <dl>
                <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Tipo de Carga</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $package->carge_type }}</dd>
                </div>
                <div class="bg-black px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Tamaño</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $package->size }}</dd>
                </div>
                <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Peso</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $package->weight }}</dd>
                </div>
                <div class="bg-black px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Punto Inicial</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $package->point_initial }}</dd>
                </div>
                <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Punto Final</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $package->point_finally }}</dd>
                </div>
                <div class="bg-black px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Descripción</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $package->description }}</dd>
                </div>
                <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Precio</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">${{ number_format($package->price, 2) }}</dd>
                </div>
                <div class="bg-black px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Estado</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $package->state }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="bg-black shadow rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-gray-800">
            <h3 class="text-lg leading-6 font-medium text-white">
                Información del Cliente
            </h3>
        </div>
        <div class="border-t border-gray-700">
            <dl>
                <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Nombre</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $customer->name }}</dd>
                </div>
                <div class="bg-black px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Documento</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $customer->document }}</dd>
                </div>
                <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Teléfono</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $customer->phone }}</dd>
                </div>
                <div class="bg-black px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Dirección</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $customer->address }}</dd>
                </div>
                <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Correo</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $customer->email }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>