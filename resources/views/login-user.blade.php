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
      padding: 0;
    }
    body {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
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
      position: fixed;
      top: 0; /* Ensures the header stays at the top */
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
      flex-direction: column;
      align-items: center;
      justify-content: flex-start; /* Content starts below the header */
      text-align: center;
      width: 100%;
      flex: 1; /* Allows main to grow and push footer down */
      padding-top: 60px; /* Adds space below the header */
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
      width: 90%; /* Ajuste de ancho para pantallas pequeñas */
      margin: 5%;
      max-width: 400px; /* Ancho máximo */
      max-height: 100%;
      padding: 2rem; /* Añadir padding para espaciar contenido */
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
      <div class="lg:hidden flex items-center justify-end">
        <button id="menu-toggle" class="focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="a_header product text-sm font-semibold leading-6">Inicio</a>
        <a href="#" class="a_header features text-sm font-semibold leading-6">Acerca de</a>
        <a href="#contact" class="a_header marketplace text-sm font-semibold leading-6">Contacto</a>
        <a href="#company" class="a_header company text-sm font-semibold leading-6">Compañía</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="/login-user" class="login text-sm font-semibold leading-6 hover:uppercase">Iniciar sesión<span aria-hidden="true">&rarr;</span></a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="/admin/login" class="login text-sm font-semibold leading-6 hover:uppercase">Soy conductor<span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>
    <div id="menu" class="hidden lg:hidden">
      <!-- Links para pantallas pequeñas -->
      <div class="flex flex-col p-4 bg-gray-100">
        <a href="#" class="a_header product text-sm font-semibold leading-6">Inicio</a>
        <a href="#" class="a_header features text-sm font-semibold leading-6">Acerca de</a>
        <a href="#contact" class="a_header marketplace text-sm font-semibold leading-6">Contacto</a>
        <a href="#company" class="a_header company text-sm font-semibold leading-6">Compañía</a>
        <a href="/login-user" class="login text-sm font-semibold leading-6 hover:uppercase">Iniciar sesión<span aria-hidden="true">&rarr;</span></a>
        <a href="/admin/login" class="login text-sm font-semibold leading-6 hover:uppercase">Soy conductor<span aria-hidden="true">&rarr;</span></a>
      </div>
    </div>
  </header>
  
  <main>
    <div class="container mx-auto">
      <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <div class="div-img">
            <img class="img-user mx-auto w-auto" src="{{ asset('img/logo_final_filament.png') }}" alt="Your Company">
          </div>
          <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-white">Inicia sesión</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="#" method="POST">
            <div>
              <label for="email" class="block text-sm font-medium leading-6 text-white">Correo electronico</label>
              <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
            <div>
              <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-white">Contraseña</label>
                <div class="text-sm">
                  <a href="#" class="font-semibold text-white hover:text-indigo-500">Olvidaste tu contraseña?</a>
                </div>
              </div>
              <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
            <div>
              <button type="submit" class="button-sign flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ingresa</button>
            </div>
          </form>
          <p class="mt-10 text-center text-sm text-gray-500">
            No estás registrado?
            <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Registrate aquí</a>
          </p>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <p>&copy; 2024 AgroDrive. Todos los derechos reservados. Prohibida la reproducción total o parcial sin autorización.</p>
  </footer>
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
