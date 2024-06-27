<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroDrive</title>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />  
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 6%;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgba(151, 167, 153, 0.8); /* Verde muy claro y translúcido */
      color: #4A4A4A;
      min-height: 100vh;
    }
    #map {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      z-index: -1; /* Para que el mapa esté en el fondo */
    }
    header {
      background-color: rgba(161, 173, 149, 0.8);
      width: 100%;
      text-align: center;
      padding: 0.1rem;
      position:fixed;
      top: 0; 
      z-index: 1000;
    }
    footer {
      background-color: rgba(161, 173, 149, 0.8);
      width: 100%;
      text-align: center;
      padding: 0.1rem;
      z-index: 1;
    }
    .header-logo {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .header-logo .agro {
      color: #2C6E49; /* Verde oscuro */
    }
    .header-logo .drive {
      color: #4A4A4A;
    }
    .header-logo img {
      height: 40px;
      margin-right: 10px;
    }
    .header-logo span {
      font-size: 1.5em;
      font-weight: bold;
      color: #2C6E49;
    }
    main {
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      width: 50%;
      flex: 1;
      padding-top: 60px;
    }
    .content {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 1rem;
      border-radius: 10px;
      margin-bottom: 20px;
      margin-top: 3%;
    }
    .a_header {
      color: #000000;
      transition: transform 0.3s ease;
    }
    .a_header:hover {
      transform: scale(1.1);
    }
    section {
      box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
      margin: 10%;
      margin-top: 8%;
    }
    .card-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }
    .card {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center; /* Centrar el contenido dentro de la tarjeta */
    }
    .card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      display: block;
      margin: 0 auto; /* Centrar la imagen */
    }
    .contact-card {
      max-width: 400px; /* Ancho máximo diferente para las tarjetas de contacto */
    }
    .contact-card button {
      background-color: #2C6E49; /* Color de fondo verde oscuro */
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px; /* Espacio entre el botón y el contenido */
      text-align: center;
    }
    .contact-card button:hover {
      background-color: #255B3F; /* Color más oscuro en hover */
    }
    .about-img{
      margin: 2%;
    }
    h2, p{
      color: #000000;
    }
    h4{
        color: black !important;
        font-size: 20px;
        font-weight: bold;
    }
    .container{
      background-color: #000000c0;
      border-radius: 5px;
      width: auto;
      margin: 5%;
      max-width: 400px;
      max-height: 100%;
      padding: 2rem;
    }
    .button-sign{
      background-color: #255B3F;
    }
    .div-img{
      height: 100px;
    }
    .img-user{
      height: 140px;
    }

  </style>
</head>
<body>
  <div id="map"></div>
  <header class="lg:fixed lg:w-full">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1 header-logo">
        <img class="img_header" type="image/png" src="{{ asset('img/Logo_final_filament.png') }}" alt="Logo">
        <span class="agro">Agro</span><span class="drive">Drive</span>
      </div>
      </nav>
  </header>
  
  <main>
    <div class="container mx-auto">
      @livewire('registru')
    </div>
  </main>
  {{-- <footer>
    <p>&copy; 2024 AgroDrive. Todos los derechos reservados. Prohibida la reproducción total o parcial sin autorización.</p>
  </footer> --}}
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
              L.marker([lat, lng]).addTo(map).openPopup();
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
