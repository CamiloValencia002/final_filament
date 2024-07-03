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
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item h5">
                        <span class="bi nav-link font-weight-bold">Bienvenido, {{ Auth::user()->name }} |</span>
                    </li>
                    <li class="nav-item h5">
                        <a class="bi bi-houses-fill nav-link font-weight-bold" href="/">Inicio |</a>
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
                                $ratings = Auth::user()->ratings;
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $ratings)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-warning"></i>
                                    @endif
                                @endfor
                                {{ $ratings }}
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
            </div>
        </div>
    </nav>
</header>
