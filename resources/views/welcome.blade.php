<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido | Sistema Bibliotecario PRO</title>

    {{-- Recursos externos usados solo en la pantalla de bienvenida publica. --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        /* Estilos de presentacion para la portada inicial del sistema. */
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Source Sans Pro', sans-serif;
        }
        .welcome-box {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 50px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        }
        .btn-custom {
            padding: 12px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            margin: 10px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        h1 {
            font-size: 4rem;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .lead {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            {{-- Caja principal de bienvenida con accesos a login, registro o dashboard si ya hay sesion. --}}
            <div class="col-md-10 welcome-box">
                <i class="fas fa-book-reader fa-5x mb-4 text-primary"></i>
                <h1>BIENVENIDO</h1>
                <p class="lead">Sistema de Gestión y Préstamo Bibliotecario Profesional</p>
                <hr style="border-top: 1px solid rgba(255,255,255,0.3); width: 60%; margin: 20px auto;">
                
                <div class="mt-4">
                    {{-- Segun el estado de autenticacion, mostramos acceso al panel o botones de entrada/registro. --}}
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-primary btn-custom">
                                <i class="fas fa-tachometer-alt mr-2"></i> Ir al Panel de Control
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-custom">
                                <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-light btn-custom">
                                    <i class="fas fa-user-plus mr-2"></i> Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
                
                <p class="mt-5 small text-white-50">
                    &copy; {{ date('Y') }} - Biblioteca PRO. Gestión eficiente de conocimiento.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
