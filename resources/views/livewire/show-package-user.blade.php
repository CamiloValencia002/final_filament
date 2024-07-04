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
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      max-width: 1200px;
    }
    .card {
      border: none;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .table th {
      background-color: #f1f3f5;
      font-weight: 600;
    }
    .table td, .table th {
      vertical-align: middle;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card p-4 rounded-lg">
      <h1 class="h3 font-weight-bold text-center mb-4">Lista de Paquetes</h1>
      <div class="table-responsive">
        @if($packages->count() > 0)
          <table class="table table-hover">
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
                <td>
                  <span class="badge bg-{{ $package->state == 'FINALIZADO' ? 'success' : ($package->state == 'EN PROCESO' ? 'warning' : 'primary') }}">
                    {{ $package->state }}
                  </span>
                </td>
                <td>{{ $package->id }}</td>
                <td>{{ $package->carge_type }}</td>
                <td>{{ Str::limit($package->description, 30) }}</td>
                <td>{{ $package->syze }}</td>
                <td>{{ $package->weight }}</td>
                <td>{{ Str::limit($package->point_initial, 20) }}</td>
                <td>{{ Str::limit($package->point_finally, 20) }}</td>
                <td>{{ $package->price }}</td>
                <td>{{ Str::limit($package->comment, 30) }}</td>
                <td>{{ $package->created_at->format('d/m/Y') }}</td>
                <td>
                  @php
                    $rating = \App\Models\Rating::where('id_package', $package->id)
                                                ->where('id_customer', auth()->id())
                                                ->first();
                  @endphp
                
                  @if($package->state == 'FINALIZADO' && (!$rating || $rating->rating_customer === null))
                    <a href="{{ route('rate', $package->id) }}" class="btn btn-primary btn-sm">
                      <i class="bi bi-star-fill me-1"></i> Calificar
                    </a>
                  @elseif($package->state == 'EN PROCESO')
                    <span class="btn btn-danger btn-sm disabled">
                      <i class="bi bi-hourglass-split me-1"></i> En Proceso
                    </span>
                  @elseif($rating && $rating->rating_customer !== null)
                    <span class="btn btn-success btn-sm disabled">
                      <i class="bi bi-check-circle-fill me-1"></i> Calificado
                    </span>
                  @else
                    <span class="btn btn-secondary btn-sm disabled">
                      <i class="bi bi-clock-history me-1"></i> Pendiente
                    </span>
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