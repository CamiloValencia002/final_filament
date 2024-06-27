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

  </style>
</head>
<body>
  <div id="map"></div>
  <header>
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1 header-logo">
          <img class="img_header" type="image/png" src="{{ asset('img/Logo_final_filament.png') }}" alt="Logo">
          <span class="agro">Agro</span><span class="drive">Drive</span>
      </div>
      <div class="flex lg:hidden">
        <button id="menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12 menu-links">
        <a href="#" class="a_header product text-sm font-semibold leading-6">Inicio</a>
        <a href="#" class="a_header features text-sm font-semibold leading-6">Acerca de</a>
        <a href="#contact" class="a_header marketplace text-sm font-semibold leading-6">Contacto</a>
        <a href="#company" class="a_header company text-sm font-semibold leading-6">Compañía</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end menu-links">
        <a href="/login-user" class="login text-sm font-semibold leading-6 hover:uppercase">Iniciar sesión<span aria-hidden="true">&rarr;</span></a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end menu-links">
        <a href="/driver/login" class="login text-sm font-semibold leading-6 hover:uppercase">Soy conductor<span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>
    <div id="mobile-menu" class="hidden lg:hidden">
      <a href="#" class="block a_header product text-sm font-semibold leading-6 p-2">Inicio</a>
      <a href="#" class="block a_header features text-sm font-semibold leading-6 p-2">Acerca de</a>
      <a href="#contact" class="block a_header marketplace text-sm font-semibold leading-6 p-2">Contacto</a>
      <a href="#company" class="block a_header company text-sm font-semibold leading-6 p-2">Compañía</a>
      <a href="/login-user" class="block login text-sm font-semibold leading-6 p-2 hover:uppercase">Iniciar sesión<span aria-hidden="true">&rarr;</span></a>
      <a href="/admin/login" class="block login text-sm font-semibold leading-6 p-2 hover:uppercase">Soy conductor<span aria-hidden="true">&rarr;</span></a>
    </div>
  </header>
  <main>
    <section id="" class="content about-border flex flex-col items-center">
      <h2 class="text-2xl font-bold mb-4">Acerca de</h2>
      <p>En AgroDrive, transformamos la forma en que se transportan los productos agropecuarios. Nos especializamos en conectar a agricultores y productores con conductores especializados en el transporte de productos agrícolas, ofreciendo un servicio eficiente, seguro y confiable.</p>
      <div class="about-img flex justify-center items-center w-40 h-40">
        <img class="w-full h-full" type="image/png" src="{{ asset('img/Logo_final_filament.png') }}" alt="Logo">
      </div>
      <div class="text-left"> <!-- Añadido para alinear los puntos a la izquierda -->
        <p><strong>¿Cómo Funciona?</strong></p>
        <p>1. <strong>Solicitud de Servicio:</strong> A través de nuestra plataforma, los agricultores y productores pueden solicitar el transporte de sus productos.</p>
        <p>2. <strong>Asignación de Conductores:</strong> Los conductores registrados en nuestra red aceptan las solicitudes según su disponibilidad y cercanía.</p>
        <p>3. <strong>Transporte Seguro:</strong> El producto es recogido y transportado con el máximo cuidado y profesionalismo, garantizando su llegada en óptimas condiciones.</p>
        <p>4. <strong>Pago y Confirmación:</strong> El costo del servicio es transparente y competitivo, y el pago se realiza de manera segura a través de nuestra plataforma.</p>
      </div>
    </section>
    <section class="m-8 p-2" id="contact">
    </section>
    <section id="" class="content">
      <h2 class="text-2xl font-bold mb-4">Contactenos</h2>
      <div class="card-container">
        <div class="card contact-card">
          <img src="{{ asset('img/gmaillogo.jpeg') }}" alt="Correo Electronico">
          <p>Contactanos a traves de nuestro <strong>Correo Electronico</strong> dando click aquí.<strong>⭣</strong></p>
          <button><a href="">Contactar</a></button>
        </div>
        <div class="card contact-card">
          <img src="{{ asset('img/whatsapplogo.jpeg') }}" alt="WhatsApp">
          <p>Contactanos a traves de nuestro de canales de <strong>WhatsApp</strong> haciendo click aquí<strong>⭣</strong></p>
          <button><a href="">Contactar</a></button>
        </div>
        <div class="card contact-card">
          <img src="{{ asset('img/githublogo.jpeg') }}" alt="GitHub">
          <p>Para conocer mejor nuestros trabajos en nuestros repositorios de <strong>GitHub</strong> haz click aquí <strong>⭣</strong></p>
          <button><a href="">Contactar</a></button>
        </div>
      </div>
    </section>
    <section class="m-2" id="company">
    </section>
    <section id="" class="content">
      <h2 class="text-2xl font-bold mb-4">Compañia</h2>
      <div class="card-container">
        <div class="card">
          <img src="{{ asset('img/fotoperfilcompany.png') }}" alt="Foto de perfil">
          <h4 class="company-text">Edward Millán</h4>
        </div>
        <div class="card">
          <img src="{{ asset('img/fotoperfilcompany.png') }}" alt="Foto de perfil">
          <h4 class="company-text">Camilo Vargas</h4>
        </div>
        <div class="card">
          <img src="{{ asset('img/fotoperfilcompany.png') }}" alt="Foto de perfil">
          <h4 class="company-text">Alejandro Rojas</h4>
        </div>
        <div class="card">
          <img src="{{ asset('img/fotoperfilcompany.png') }}" alt="Foto de perfil">
          <h4 class="company-text">Juan Camilo Valencia</h4>
        </div>
        <div class="card">
          <img src="{{ asset('img/fotoperfilcompany.png') }}" alt="Foto de perfil">
          <h4 class="company-text">Alejandro Martinez</h4>
        </div>
      </div>
    </section>    
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

    // Mobile menu toggle
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
