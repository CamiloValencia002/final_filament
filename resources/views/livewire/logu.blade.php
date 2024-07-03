<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroDrive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .login-form {
      max-width: 300px;
      margin: auto;
    }
    .btn-floating {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <div class="bg-white p-3 rounded shadow-sm login-form">
      <h1 class="h5 font-weight-bold mb-3 text-center">Iniciar sesión</h1>

      @if (session()->has('error'))
        <div class="alert alert-danger py-2 small">
          {{ session('error') }}
        </div>
      @endif

      <form wire:submit.prevent="login" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
          <label for="email" class="form-label small">Correo Electrónico</label>
          <input type="email" id="email" wire:model="email" class="form-control form-control-sm" required>
          @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
          <label for="password" class="form-label small">Contraseña</label>
          <input type="password" id="password" wire:model="password" class="form-control form-control-sm" required>
          @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success btn-sm w-100 mb-2">Iniciar sesión</button>

        <div class="text-center small">
          <p class="mb-1">¿No eres miembro? <a href="/register-user" class="text-decoration-none">Registrarse</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>