<!-- resources/views/layouts/header.blade.php -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand h2" href="#">
                <img src="{{ asset('img/Logo_final_filament.png') }}" height="60" alt="Logo">
                <strong><span class="text-success">Agro</span><span class="text-dark">Drive</span></strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item h5">
                        <span class="bi nav-link font-weight-bold">Bienvenido, {{ Auth::user()->name }} |</span>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-houses-fill nav-link font-weight-bold" href="/">Inicio |</a>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-truck nav-link font-weight-bold" href="#travel">Mis viajes |</a>
                    </li>
                    <li class="nav-item h5">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success font-weight-bold">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>