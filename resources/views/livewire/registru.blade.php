<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @livewireStyles
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="container register">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Registro de Usuario</h2>
                        
                        @if (session()->has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="register" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" wire:model="name">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="last_name" wire:model="last_name">
                                        @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" wire:model="email">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password" wire:model="password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telephone" wire:model="telephone">
                                        @error('telephone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="address" wire:model="address">
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="document" class="form-label">Documento</label>
                                        <input type="text" class="form-control" id="document" wire:model="document">
                                        @error('document') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>