<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgroDrive</title>
    <!-- Enlaces a tus estilos CSS y librerías -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Estilos CSS personalizados -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            background: rgba(151, 167, 153, 0.8);
            color: #4a4a4a;
            overflow-x: hidden;
        }

        #map {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
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
            z-index: 2;
            width: 100%;
            transition: top 0.3s ease-in-out;
        }

        .navbar.fixed {
            top: -100px; /* Altura del navbar cuando se desplaza arriba */
        }

        .navbar .nav-link {
            color: #fff;
        }

        .navbar .btn {
            background-color: #2c6e49;
            border-color: #2c6e49;
        }

        .navbar .btn:hover {
            background-color: #255c3d;
            border-color: #255c3d;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
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

        .content {
            background-color: transparent;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .section {
            width: 100%;
            max-width: 1100px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            margin-bottom: 20px;
            padding: 20px;
        }

        .footer {
            background-color: rgba(92, 151, 94, 0.8);
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: relative;
            z-index: 1;
            transition: bottom 0.3s ease-in-out;
        }

        .footer.fixed {
            bottom: -100px; /* Altura del footer cuando se desplaza hacia abajo */
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <!-- Encabezado -->
    <div class="navbar" id="header">
        @include('layouts.header')
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <div class="section">
            @include('layouts.dashboard')
        </div>

      {{--   <div class="section">
            {{-- @include('layouts.packages') --}}
      {{--   </div> --}} 
    </div>

    <!-- Pie de página -->
    <div class="footer" id="footer">
        <footer>
            <p>&copy; 2024 AgroDrive. Todos los derechos reservados. Prohibida la reproducción total o parcial sin autorización.</p>
        </footer>
    </div>

    <!-- Scripts JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Script del mapa Leaflet
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

        // Manejar el desplazamiento del encabezado y el pie de página
        let lastScrollTop = 0;
        const navbar = document.getElementById('header');
        const footer = document.getElementById('footer');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Desplazamiento hacia abajo
                navbar.classList.add('fixed');
                footer.classList.add('fixed');
            } else {
                // Desplazamiento hacia arriba
                navbar.classList.remove('fixed');
                footer.classList.remove('fixed');
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>
</html>
