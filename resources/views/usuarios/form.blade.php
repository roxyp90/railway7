{{-- Formulario base reutilizado para crear y editar usuarios en dos líneas --}}
@csrf

{{-- Primera Línea: Nombre (6) y Correo (6) = 12 --}}
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $usuario->name ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="email">Correo</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email ?? '') }}" required>
    </div>
</div>

{{-- Segunda Línea: Contraseña (5) + Confirmar contraseña (5) + Activo (2) = 12 --}}
<div class="form-row">
    <div class="form-group col-md-5">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
    </div>
    <div class="form-group col-md-5">
        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
    </div>
    <div class="form-group col-md-2 d-flex align-items-center justify-content-center">
        <div class="custom-control custom-switch mt-4">
            {{-- Este hidden asegura que el campo activo siempre viaje aunque el switch esté apagado. --}}
            <input type="hidden" name="activo" value="0">
            <input type="checkbox" name="activo" value="1" class="custom-control-input" id="activo" {{ old('activo', $usuario->activo ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="activo">Activo</label>
        </div>
    </div>
</div>

{{-- Botonera de acciones --}}
<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>