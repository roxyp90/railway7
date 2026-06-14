@extends('layouts.app')

@section('content')
{{-- Pantalla de inicio de sesion para entrar al panel administrativo. --}}
<div class="login-page" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
    <div class="login-box">
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-header text-center mt-3">
                <h1 class="h1"><b>Biblioteca</b>PRO</h1>
                <p class="text-muted">Bienvenido al sistema de gestion</p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Inicia sesion para acceder al sistema de prestamo de libros</p>

                {{-- Formulario que envia las credenciales a la ruta login de Laravel. --}}
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electronico" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope text-primary"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contrasena" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-primary"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            {{-- Opcion para recordar la sesion en el navegador. --}}
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Recordar sesion</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block shadow">Entrar</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 mt-3 text-center">
                    <a href="{{ route('password.request') }}">Olvide mi contrasena</a>
                </p>
                <p class="mb-0 text-center">
                    <a href="{{ route('register') }}" class="text-center text-success">Registrar un nuevo bibliotecario</a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Ocultamos el chrome del panel para que el login se vea limpio y centrado. */
    .main-sidebar, .main-header, .main-footer { display: none !important; }
    .content-wrapper { margin-left: 0 !important; background: transparent !important; }
</style>
@endsection
