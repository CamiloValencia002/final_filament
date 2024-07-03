<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Paquetes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  @livewireStyles
</head>
<body>
  <div class="container mt-5">
    <div class="bg-white p-4 rounded-lg shadow-lg max-w-md mx-auto">
      <h1 class="h4 font-weight-bold text-center mb-4">Lista de Paquetes</h1>
      <div class="table-responsive">
        @if($packages->count() > 0)
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Estado</th>
                <th>ID</th>
                <th>Tipo de Carga</th>
                <th>Descripción</th>
                <th>Tamaño</th>
                <th>Peso</th>
                <th>Punto Inicial</th>
                <th>Punto Final</th>
                <th>Precio</th>
                <th>Comentario</th>
                <th>Fecha de Creación</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach($packages as $package)
                <tr>
                  <td>{{ $package->state }}</td>
                  <td>{{ $package->id }}</td>
                  <td>{{ $package->carge_type }}</td>
                  <td>{{ $package->description }}</td>
                  <td>{{ $package->syze }}</td>
                  <td>{{ $package->weight }}</td>
                  <td>{{ $package->point_initial }}</td>
                  <td>{{ $package->point_finally }}</td>
                  <td>{{ $package->price }}</td>
                  <td>{{ $package->comment }}</td>
                  <td>{{ $package->created_at }}</td>
                  <td>
                    @php
                      $rating = \App\Models\Rating::where('id_package', $package->id)
                                                  ->where('id_customer', auth()->id())
                                                  ->first();
                    @endphp
                  
                    @if($package->state == 'FINALIZADO' && (!$rating || $rating->rating_customer === null))
                      <a href="{{ route('rate', $package->id) }}" class="btn btn-primary btn-sm">
                        Calificar
                      </a>
                    @elseif($rating && $rating->rating_customer !== null)
                      <span class="text-success">Calificado</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p class="text-center">No tienes paquetes asociados.</p>
        @endif
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  @livewireScripts
</body>
</html>