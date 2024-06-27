<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgroDrive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            background: rgba(151, 167, 153, 0.8);
            color: #4a4a4a;
            min-height: 100vh;
        }

        #map {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            /* Coloca el mapa detrás de todo */
        }

        .header-logo .agro {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #2c6e49;
        }

        .header-logo .drive {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #4a4a4a;
        }

        .navbar {
            background-color: rgba(92, 151, 94, 0.8) !important;
            height: 100px;
            position: relative;
            /* Asegura que el navbar sea relativo */
            z-index: 2;
            /* Coloca el navbar por encima del contenido */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            margin-bottom: 20px;
            width: 100%;
            /* Ajusta el ancho de los cards */
            max-width: 500px;
            /* Limita el ancho máximo de los cards */
            margin: 0 auto;
            /* Centra los cards horizontalmente */
        }

        @media (min-width: 768px) {
            .card {
                width: calc(50% - 20px);
                margin-right: 20px;
            }

            .card:nth-child(2n) {
                margin-right: 0;
            }
        }

        .container {
            max-width: 1100px;
            /* Ajusta el ancho máximo del contenedor */
            padding: 0 15px;
            /* Ajusta los márgenes internos del contenedor */
        }

        .form-container {
            margin-top: 120px;
            /* Ajusta el margen superior para separar del navbar */
            margin-bottom: 40px;
            /* Añade un margen inferior para separación */
        }

        .viajes-container {
            margin-top: 40px;
            /* Ajusta el margen superior para separar de la solicitud */
            margin-bottom: 40px;
            /* Añade un margen inferior para separación */
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg-opacity-75">
            <div class="container">
                <a class="navbar-brand header-logo" href="#">
                    <img src="{{ asset('img/Logo_final_filament.png') }}" alt="Logo" height="40"
                        class="d-inline-block align-top me-2">
                    <span class="agro">Agro</span><span class="drive">Drive</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#travel">Mis viajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container viajes-container">
        <div class="content p-4 border rounded bg-white">
            <h2 class="text-center mb-4">Mis Viajes</h2>
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Conductor</th>
                            <th scope="col">Paquete</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">Comentario</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se deben cargar dinámicamente los datos de los viajes -->
                        @foreach($packages as $package)
                        <tr>
                            <td>{{ $package['conductor'] }}</td>
                            <td>{{ $package['paquete'] }}</td>
                            <td>{{ $package['ubicacion'] }}</td>
                            <td>{{ $package['comentario'] }}</td>
                            <td>{{ $package['estado'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="bg-light bg-opacity-75 text-center py-3">
        <p class="mb-0">&copy; 2024 AgroDrive. Todos los derechos reservados. Prohibida la reproducción total o parcial
            sin autorización.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([0, 0], 2);
  
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
  
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            map.setView([lat, lng], 13);
  
            L.marker([lat, lng])
              .addTo(map)
              .openPopup();
          },
          function() {
            alert('Error: El servicio de geolocalización ha fallado.');
          }
        );
      } else {
        alert('Error: Tu navegador no soporta geolocalización.');
      }
    </script>
</body>

</html>
