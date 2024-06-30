<div>
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
</div>

{{-- <div class="container mx-auto">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="div-img">
          <img class="img-user mx-auto w-auto" src="{{ asset('img/logo_final_filament.png') }}" alt="Your Company">
        </div>
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-white">Inicia sesión</h2>
      </div>
      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="#" method="POST">
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-white">Correo electronico</label>
            <div class="mt-2">
              <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-white">Contraseña</label>
            </div>
            <div class="mt-2">
              <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
          <div>
            <button type="submit" class="button-sign flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ingresa</button>
          </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-500">
          No estás registrado?
          <a href="{{ route('register-user')}}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Registrate aquí</a>
        </p>
      </div>
    </div>
  </div>
</main> --}}
