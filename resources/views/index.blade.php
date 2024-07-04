<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroDrive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      position: relative; /* Añadido para que el footer quede correctamente fijo */
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
      position: fixed;
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

    footer {
      border-radius: 10px;
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
                        <a class="bi bi-houses-fill nav-link font-weight-bold" href="#"> Inicio |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-person-vcard-fill nav-link font-weight-bold" href="#"> Acerca de |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-telephone-outbound nav-link font-weight-bold" href="#contact"> Contacto |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-shop nav-link font-weight-bold" href="#company"> Compañía |</a>
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
                        <a class="bi bi-houses-fill nav-link font-weight-bold" href="#"> Inicio |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-person-vcard-fill nav-link font-weight-bold" href="#"> Acerca de |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-telephone-outbound nav-link font-weight-bold" href="#contact"> Contacto
                            |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-shop nav-link font-weight-bold" href="#company"> Compañía |</a>
                    </li>
                    <li class="nav-item h5">
                        <a href="/inicioUser" class="bi nav-link font-weight-bold"> Solicitar Servicio |</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li class="dropdown-item">{{ Auth::user()->email }}</li>
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
  <main class="container mt-5 pt-5">
  <section class="content-box text-center my-5">
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
      <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/logo_rectangulo.png') }}" class="d-block mx-auto mb-4 img-fluid" style="width: 1000px; height: 500px; object-fit: cover;" alt="About Me">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/carousel1.png') }}" class="d-block mx-auto mb-4 img-fluid" style="width: 1000px; height: 500px; object-fit: cover;" alt="Carousel 1">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/carousel2.jpeg') }}" class="d-block mx-auto mb-4 img-fluid" style="width: 1000px; height: 500px; object-fit: cover;" alt="Carousel 2">
    </div>
  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>       
</div>
        <ul class="list-unstyled">
          <li><span class="bi bi-envelope-plus-fill h1 text-success me-3"></span> <strong class="h3">Solicitud de Servicio</strong></li>
          <li><span class="bi bi-car-front-fill h1 text-success me-3"></span> <strong class="h3">Asignación de Conductores</strong></li>
          <li><span class="bi bi-shield-fill-check h1 text-success me-3"></span><strong class="h3">Transporte Seguro</strong></li>
        </ul>
      </div>
    </div>
    </div>
  </section>
<section id="contact" class="content-box my-5">
  <h2 class="text-center font-weight-bold mb-4">Contáctenos</h2>
  <div class="row justify-content-center">
    <div class="col-md-4 text-center mb-4">
      <img src="{{ asset('img/gmaillogo.jpeg') }}" class="rounded-circle mb-3" alt="Correo Electrónico" width="100" height="100">
      <p>Contactanos a través de nuestro <strong>Correo Electrónico</strong> dando click aquí.</p>
      <a href="" class="btn btn-success btn-lg btn-block font-weight-bold">Contactar</a>
    </div>
    <div class="col-md-4 text-center mb-4">
      <img src="{{ asset('img/whatsapplogo.jpeg') }}" class="rounded-circle mb-3" alt="WhatsApp" width="100" height="100">
      <p>Contactanos a través de nuestro canal de <strong>WhatsApp</strong> haciendo click aquí.</p>
      <a href="" class="btn btn-success btn-lg btn-block font-weight-bold">Contactar</a>
    </div>
    <div class="col-md-4 text-center mb-4">
      <img src="{{ asset('img/githublogo.jpeg') }}" class="rounded-circle mb-3" alt="GitHub" width="100" height="100">
      <p>Para conocer mejor nuestros trabajos en nuestros repositorios de <strong>GitHub</strong> haz click aquí.</p>
      <a href="" class="btn btn-success btn-lg btn-block font-weight-bold">Contactar</a>
    </div>
  </div>
</section>

<section id="company" class="content-box my-5">
  <h2 class="text-center font-weight-bold mb-5">Compañía</h2>
  <div class="row justify-content-center">
    <div class="col-md-2 text-center mb-4">
      <img src="{{ asset('img/edward.jfif') }}" class="rounded-circle mb-3 img-fluid shadow" alt="Edward Millán" style="width: 150px; height: 150px; object-fit: cover;">
      <h4 class="font-weight-bold">Edward Millán</h4>
    </div>
    <div class="col-md-2 text-center mb-4">
      <img src="{{ asset('img/vargas.jfif') }}" class="rounded-circle mb-3 img-fluid shadow" alt="Camilo Vargas" style="width: 150px; height: 150px; object-fit: cover;">
      <h4 class="font-weight-bold">Camilo Vargas</h4>
    </div>
    <div class="col-md-2 text-center mb-4">
      <img src="{{ asset('img/rojas.jfif') }}" class="rounded-circle mb-3 img-fluid shadow" alt="Alejandro Rojas" style="width: 150px; height: 150px; object-fit: cover;">
      <h4 class="font-weight-bold">Alejandro Rojas</h4>
    </div>
    <div class="col-md-2 text-center mb-4">
      <img src="{{ asset('img/valencia.jfif') }}" class="rounded-circle mb-3 img-fluid shadow" alt="Juan Camilo Valencia" style="width: 150px; height: 150px; object-fit: cover;">
      <h4 class="font-weight-bold">Juan Camilo Valencia</h4>
    </div>
    <div class="col-md-2 text-center mb-4">
      <img src="{{ asset('img/martinez.jfif') }}" class="rounded-circle mb-3 img-fluid shadow" alt="Alejandro Martinez" style="width: 150px; height: 150px; object-fit: cover;">
      <h4 class="font-weight-bold">Alejandro Martinez</h4>
    </div>
  </div>
</section>

  </main>
  <footer class="bg-light py-3 text-center ml-5 mr-5 rounded-5">
    <div class="container">
      <p class="font-weight-bold">&copy; 2024 <a href="/admin/login">AgroDrive</a>. Todos los derechos reservados. Prohibida la reproducción total o parcial sin autorización.</p>
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
</body>
</html>