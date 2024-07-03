<div>
  @if($userName)
    <div>Bienvenido, {{ $userName }}</div>

@else
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6">Iniciar sesión</h1>

        @if (session()->has('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="login" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Correo Electrónico</label>
                <input type="email" id="email" wire:model="email" class="w-full p-2 border border-gray-300 rounded">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input type="password" id="password" wire:model="password" class="w-full p-2 border border-gray-300 rounded">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Iniciar sesión</button>
        </form>
    </div>
    @endif
</div>
