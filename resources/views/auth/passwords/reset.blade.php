@extends('layouts.app')

@section('content')
{{-- Pantalla final de recuperacion donde se asigna la nueva contrasena. --}}
<div class="login-page reset-auth-page">
    <div class="login-box reset-auth-box">
        <div class="card card-outline card-primary shadow-lg reset-auth-card">
            <div class="card-header text-center mt-3 pb-2">
                <div class="reset-auth-icon mx-auto mb-3">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1 class="h1 mb-1"><b>Biblioteca</b>PRO</h1>
                <p class="text-muted mb-0">Nueva contrasena</p>
            </div>

            <div class="card-body">
                <p class="login-box-msg px-2">
                    Crea una contrasena segura para volver a entrar al sistema.
                </p>

                {{-- Este formulario usa el token enviado por correo para validar el cambio de contrasena. --}}
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-3">
                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ $email ?? old('email') }}"
                            placeholder="Correo electronico"
                            required
                            autocomplete="email"
                            autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope text-primary"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="Nueva contrasena"
                            required
                            autocomplete="new-password"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-primary"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input
                            id="password-confirm"
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            placeholder="Confirmar contrasena"
                            required
                            autocomplete="new-password"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-check text-primary"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block shadow-sm">
                        <i class="fas fa-save mr-1"></i> Restablecer contrasena
                    </button>
                </form>

                <p class="mb-0 mt-3 text-center">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left mr-1"></i> Volver al inicio de sesion
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .reset-auth-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background:
            radial-gradient(circle at top left, rgba(255, 255, 255, 0.18), transparent 34%),
            linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        padding: 24px 12px;
    }

    .reset-auth-box {
        width: 430px;
        max-width: 100%;
    }

    .reset-auth-card {
        border-radius: 8px;
        overflow: hidden;
    }

    .reset-auth-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(59, 130, 246, 0.12);
        color: #2563eb;
        font-size: 24px;
    }

    .main-sidebar, .main-header, .main-footer { display: none !important; }
    .content-wrapper { margin-left: 0 !important; background: transparent !important; }
</style>
@endsection
