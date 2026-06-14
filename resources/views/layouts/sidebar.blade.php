<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Marca principal del sistema y acceso rapido al dashboard. --}}
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Biblioteca <span class="text-primary">Pro</span></span>
    </a>

    <div class="sidebar">
        {{-- Resumen corto del usuario autenticado que esta usando el sistema. --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <div class="bg-primary img-circle elevation-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-user-tie text-white"></i>
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block ml-2">
                    <span class="font-weight-light">Hola,</span>
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <span class="badge badge-success ml-2" style="font-size: 0.6rem;">
                    <i class="fas fa-circle fa-xs mr-1"></i> En linea
                </span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                {{-- Acceso al panel principal con indicadores generales. --}}
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Panel principal</p>
                    </a>
                </li>

                {{-- Modulos principales del CRUD administrativo. --}}
                <li class="nav-header">GESTION PRINCIPAL</li>

                <li class="nav-item">
                    <a href="{{ route('libros.index') }}" class="nav-link {{ request()->is('libros*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-open text-info"></i>
                        <p>Libros</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->is('usuarios*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield text-primary"></i>
                        <p>Usuarios</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('lectores.index') }}" class="nav-link {{ request()->is('lectores*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog text-success"></i>
                        <p>Lectores / Clientes</p>
                    </a>
                </li>

                {{-- Modulos del flujo operativo de prestamos y sanciones. --}}
                <li class="nav-header">FLUJO DE TRABAJO</li>

                <li class="nav-item">
                    <a href="{{ route('prestamos.index') }}" class="nav-link {{ request()->is('prestamos*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exchange-alt text-warning"></i>
                        <p>Prestamos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sanciones.index') }}" class="nav-link {{ request()->is('sanciones*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield text-danger"></i>
                        <p>Sanciones</p>
                    </a>
                </li>

                {{-- Acciones relacionadas con la sesion del usuario actual. --}}
                <li class="nav-header">CUENTA</li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-light">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Cerrar sesion</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
