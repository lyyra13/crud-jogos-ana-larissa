<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded mb-4">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">
            GameZone
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Início
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jogos.index') }}">
                        Jogos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categorias.index') }}">
                        Categorias
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('desenvolvedoras.index') }}">
                        Desenvolvedoras
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('plataformas.index') }}">
                        Plataformas
                    </a>
                </li>

            </ul>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-danger">
                    Sair
                </button>
            </form>

        </div>
    </div>
</nav>