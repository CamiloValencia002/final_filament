<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroDrive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
      #map {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      z-index: -1;
    }
    header {
      width: 90%;
      margin-left: 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position:fixed;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000;
    }
    .content-box {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    }

    main {
    flex: 1;
    }
    .main-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    } 
    footer {
    background-color: white;
    border-radius: 10px 10px 0 0;
    padding: 15px 0;
    box-shadow: 0 -5px 5px -5px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1000;
    width: 100%;
    margin-top: auto;
    }
    .container.login{
    padding-top: 120px;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand h2" href="#">
                <img src="{{ asset('img/Logo_final_filament.png') }}" height="60" alt="Logo">
                <strong><span class="text-success">Agro</span><span class="text-dark">Drive</span></strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @guest
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item h5">
                        <a class="bi bi-houses-fill nav-link font-weight-bold" href="#">Inicio |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-person-vcard-fill nav-link font-weight-bold" href="#">Acerca de |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-telephone-outbound nav-link font-weight-bold" href="#contact">Contacto |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-shop nav-link font-weight-bold" href="#company">Compañía |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-person-circle nav-link font-weight-bold" href="/login-user">Iniciar sesión
                            |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-taxi-front nav-link font-weight-bold" href="/driver/login">Soy
                            Conductor</a>
                    </li>
                </ul>
                @else
                <ul class="navbar-nav me-auto">
                    <li class="nav-item h5">
                        <a class="bi bi-houses-fill nav-link font-weight-bold" href="/">Inicio |</a>
                    </li>
                    <li class="nav-item h5">
                        <a href="/inicioUser" class="bi nav-link font-weight-bold">Solicitar Servicio |</a>
                    </li>
                </ul>
                <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ Auth::user()->name }}
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">
                      @php
                      $user = Auth::user();
                      $averageRating = \App\Models\Rating::where('id_customer', $user->id)
                          ->avg('rating_driver');
                      $roundedRating = round($averageRating, 1);
                      @endphp
                      @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= $roundedRating)
                              <i class="bi bi-star-fill text-warning"></i>
                          @else
                              <i class="bi bi-star text-warning"></i>
                          @endif
                      @endfor
                      {{ $roundedRating }}
                  </a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
                          </form>
                      </li>
                  </ul>
              </div>
                @endguest
            </div>
        </div>
    </nav>
  </header>
  <div class="main-content">
    <div class="container login">
     <div>
       @livewire('show-package-user')
      </div> 
    </div>
  </div>
  <footer class="text-center">
    <div class="container">
      <p class="mb-0">&copy; 2024 <a href="/admin/login">AgroDrive</a>. Todos los derechos reservados. Prohibida la reproducción total o parcial sin autorización.</p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([0, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function(position) {
          const userLocation = [position.coords.latitude, position.coords.longitude];
          map.setView(userLocation, 13);
          L.marker(userLocation).addTo(map).bindPopup("Estás aquí.").openPopup();
        },
        function() {
          alert('Error: El servicio de geolocalización ha fallado.');
        }
      );
    } else {
      alert('Error: Tu navegador no soporta geolocalización.');
    }
  </script>
  @include('sweetalert::alert')
</body>
</html>