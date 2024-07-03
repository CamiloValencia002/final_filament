<!-- resources/views/layouts/header.blade.php -->
<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-opacity-75">
        <div class="container">
            <a class="navbar-brand header-logo" href="#">
                <img src="{{ asset('img/Logo_final_filament.png') }}" alt="Logo" height="40" class="d-inline-block align-top me-2">
                <span class="agro">Agro</span><span class="drive">Drive</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a>Bienvenido, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#travel">Mis viajes</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link" >Cerrar sesión</button>
                        </form>                
                    </li>          
                </ul>
            </div>
            
        </div>
    </nav>
</header>
