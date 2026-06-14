{{-- Formulario base del módulo de préstamos en dos líneas --}}
@csrf

{{-- Primera Línea: Lector (3) + Ejemplar (3) + Estado (3) + Registrado por (3) = 12 --}}
<div class="row">
    <div class="form-group col-md-3">
        <label for="usuario_id">Lector</label>
        <select name="usuario_id" id="usuario_id" class="form-control" required>
            <option value="">Selecciona un lector</option>
            @foreach($lectores as $lector)
                <option value="{{ $lector->id }}" {{ (string) old('usuario_id', $prestamo->usuario_id ?? '') === (string) $lector->id ? 'selected' : '' }}>
                    {{ $lector->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="ejemplar_id">Ejemplar</label>
        <select name="ejemplar_id" id="ejemplar_id" class="form-control" required>
            <option value="">Selecciona un ejemplar</option>
            @foreach($ejemplares as $ejemplar)
                <option value="{{ $ejemplar->id }}" {{ (string) old('ejemplar_id', $prestamo->ejemplar_id ?? '') === (string) $ejemplar->id ? 'selected' : '' }}>
                    {{ $ejemplar->codigo_inventario }} - {{ $ejemplar->libro->titulo ?? 'Sin libro' }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="estado">Estado préstamo</label>
        <select name="estado" id="estado" class="form-control" required>
            @foreach(['prestado' => 'Prestado', 'devuelto' => 'Devuelto'] as $value => $label)
                <option value="{{ $value }}" {{ old('estado', $prestamo->estado ?? 'prestado') === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="registrado_por">Registrado por</label>
        <select name="registrado_por" id="registrado_por" class="form-control" required>
            <option value="">Selecciona un usuario</option>
            @foreach($registradores as $registrador)
                <option value="{{ $registrador->id }}" {{ (string) old('registrado_por', $prestamo->registrado_por ?? '') === (string) $registrador->id ? 'selected' : '' }}>
                    {{ $registrador->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- Segunda Línea: Fecha préstamo (3) + Fecha devolución (3) + Fecha entrega real (4) + Activo (2) = 12 --}}
<div class="row">
    <div class="form-group col-md-3">
        <label for="fecha_prestamo">Fecha préstamo</label>
        <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="{{ old('fecha_prestamo', $prestamo->fecha_prestamo ?? '') }}" required>
    </div>
    <div class="form-group col-md-3">
        <label for="fecha_devolucion">Fecha devolución</label>
        <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" value="{{ old('fecha_devolucion', $prestamo->fecha_devolucion ?? '') }}">
    </div>
    <div class="form-group col-md-4">
        <label for="fecha_entrega_real">Fecha entrega real</label>
        <input type="date" name="fecha_entrega_real" id="fecha_entrega_real" class="form-control" value="{{ old('fecha_entrega_real', $prestamo->fecha_entrega_real ?? '') }}">
    </div>
    <div class="form-group col-md-2 d-flex align-items-center justify-content-center">
        <div class="custom-control custom-switch mt-4">
            {{-- Estado administrativo del préstamo. --}}
            <input type="hidden" name="activo" value="0">
            <input type="checkbox" name="activo" value="1" class="custom-control-input" id="activo" {{ old('activo', $prestamo->activo ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="activo">Activo</label>
        </div>
    </div>
</div>

{{-- Botonera de acciones --}}
<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Volver</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
