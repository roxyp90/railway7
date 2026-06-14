@extends('layouts.app')

@section('content')
{{-- Pantalla para registrar nuevo personal autorizado dentro del sistema. --}}
<div class="register-page" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #065f46 0%, #10b981 100%);">
    <div class="register-box">
        <div class="card card-outline card-success shadow-lg">
            <div class="card-header text-center mt-3">
                <h1 class="h1"><b>Registro</b> de personal</h1>
                <p class="text-muted">Sistema de prestamo bibliotecario</p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Registrar nuevo bibliotecario o personal</p>

                {{-- Formulario de alta de usuarios autenticables del sistema. --}}
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre completo" value="{{ old('name') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user text-success"></span>
                            </div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo institucional" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope text-success"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contrasena" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-success"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir contrasena" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-check-double text-success"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block shadow">Finalizar registro</button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center d-block mt-3">Ya tengo una cuenta registrada</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Igual que en login, quitamos sidebar y header para una experiencia limpia. */
    .main-sidebar, .main-header, .main-footer { display: none !important; }
    .content-wrapper { margin-left: 0 !important; background: transparent !important; }
</style>
@endsection
