<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  @livewireStyles
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6">Registro de Usuario</h1>
    
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="register" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <label for="name" class="block text-gray-700">Nombre</label>
        <input type="text" id="name" wire:model="name" class="w-full p-2 border border-gray-300 rounded">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
      </div>
      
      <div class="mb-4">
        <label for="last_name" class="block text-gray-700">Apellido</label>
        <input type="text" id="last_name" wire:model="last_name" class="w-full p-2 border border-gray-300 rounded">
        @error('last_name') <span class="text-red-500">{{ $message }}</span> @enderror
      </div>
      
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
      
      <div class="mb-4">
        <label for="telephone" class="block text-gray-700">Teléfono</label>
        <input type="text" id="telephone" wire:model="telephone" class="w-full p-2 border border-gray-300 rounded">
        @error('telephone') <span class="text-red-500">{{ $message }}</span> @enderror
      </div>
      
      <div class="mb-4">
        <label for="address" class="block text-gray-700">Dirección</label>
        <input type="text" id="address" wire:model="address" class="w-full p-2 border border-gray-300 rounded">
        @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
      </div>
      
      <div class="mb-4">
        <label for="document" class="block text-gray-700">Documento</label>
        <input type="text" id="document" wire:model="document" class="w-full p-2 border border-gray-300 rounded">
        @error('document') <span class="text-red-500">{{ $message }}</span> @enderror
      </div>
      
      <div class="mb-4">
        <label for="role" class="block text-gray-700">Rol</label>
        <input type="text" id="role" wire:model="role" class="w-full p-2 border border-gray-300 rounded">
        @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
      </div>
      
      <div class="mb-4">
        <label for="ratings" class="block text-gray-700">Calificaciones</label>
        <input type="number" step="0.1" id="ratings" wire:model="ratings" class="w-full p-2 border border-gray-300 rounded">
        @error('ratings') <span class="text-red-500">{{ $message }}</span> @enderror
      </div>
      
      {{-- <div class="mb-4">
        <label for="image" class="block text-gray-700">Imagen</label>
        <input type="file" id="image" wire:model="image" class="w-full p-2 border border-gray-300 rounded">
        @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
      </div> --}}
      
      <div class="mb-4 flex items-center">
        <input type="checkbox" id="document_verify" wire:model="document_verify" class="mr-2">
        <label for="document_verify" class="text-gray-700">Verificación de documento</label>
      </div>
      
      <button type="submit" class="w-full bg-green-600 text-white p-2 rounded">Registrar</button>
    </form>
  </div
