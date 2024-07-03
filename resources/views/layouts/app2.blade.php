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
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            color: #4a4a4a;
        }

        #map {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .content {
            flex: 1;
            padding-top: 80px; /* Ajusta esto según la altura de tu navbar */
            padding-bottom: 60px; /* Ajusta esto según la altura de tu footer */
        }

        .footer {
            background-color: #2c6e49eb;
            color: #fff;
            text-align: center;
            padding: 5px;
            margin: 0px;
            width: 100%;
            height: 7%;
        }
        
        header {
            width: 90%;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div id="map"></div>

    <div class="content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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
    </script>
    @include('sweetalert::alert')
    @livewireScripts
</body>

</html>
