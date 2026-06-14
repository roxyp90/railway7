{{-- Formulario base reutilizado para crear y editar lectores / clientes en dos líneas auditadas --}}
@csrf

{{-- Primera Línea: Nombre (6) y Correo (6) = 12 --}}
<div class="row">
    <div class="form-group col-md-6">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $lector->nombre ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="correo">Correo</label>
        <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $lector->correo ?? '') }}" required>
    </div>
</div>

{{-- Segunda Línea: Dirección (3) + Teléfono (2) + Tipo (2) + Registrado por (3) + Activo (2) = 12 --}}
<div class="row">
    <div class="form-group col-md-3">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $lector->direccion ?? '') }}">
    </div>
    <div class="form-group col-md-2">
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $lector->telefono ?? '') }}">
    </div>
    <div class="form-group col-md-2">
        <label for="tipo">Tipo</label>
        <input type="text" name="tipo" id="tipo" class="form-control" value="{{ old('tipo', $lector->tipo ?? 'cliente') }}" required>
    </div>
    <div class="form-group col-md-3">
        <label for="registrado_por">Registrado por</label>
        <select name="registrado_por" id="registrado_por" class="form-control" required>
            <option value="">Selecciona un usuario</option>
            @foreach($registradores as $registrador)
                <option value="{{ $registrador->id }}" {{ (string) old('registrado_por', $lector->registrado_por ?? '') === (string) $registrador->id ? 'selected' : '' }}>
                    {{ $registrador->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2 d-flex align-items-center justify-content-center">
        <div class="custom-control custom-switch mt-4">
            {{-- Hidden auxiliar para enviar 0 cuando el switch va en falso. --}}
            <input type="hidden" name="activo" value="0">
            <input type="checkbox" name="activo" value="1" class="custom-control-input" id="activo" {{ old('activo', $lector->activo ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="activo">Activo</label>
        </div>
    </div>
</div>

{{-- Botonera de acciones --}}
<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('lectores.index') }}" class="btn btn-secondary">Volver</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
