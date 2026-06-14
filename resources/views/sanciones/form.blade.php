{{-- Formulario base del módulo de sanciones en dos líneas --}}
@csrf

{{-- Primera Línea: Lector (3) + Préstamo (3) + Motivo (4) + Activo (2) = 12 --}}
<div class="row">
    <div class="form-group col-md-3">
        <label for="usuario_id">Lector</label>
        <select name="usuario_id" id="usuario_id" class="form-control" required>
            <option value="">Selecciona un lector</option>
            @foreach($lectores as $lector)
                <option value="{{ $lector->id }}" {{ (string) old('usuario_id', $sancion->usuario_id ?? '') === (string) $lector->id ? 'selected' : '' }}>
                    {{ $lector->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="prestamo_id">Préstamo</label>
        <select name="prestamo_id" id="prestamo_id" class="form-control" required>
            <option value="">Selecciona un préstamo</option>
            @foreach($prestamos as $prestamoItem)
                <option value="{{ $prestamoItem->id }}" {{ (string) old('prestamo_id', $sancion->prestamo_id ?? '') === (string) $prestamoItem->id ? 'selected' : '' }}>
                    #{{ $prestamoItem->id }} - {{ $prestamoItem->usuario->nombre ?? 'N/A' }} - {{ $prestamoItem->ejemplar->libro->titulo ?? 'Sin libro' }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="motivo">Motivo</label>
        <input type="text" name="motivo" id="motivo" class="form-control" value="{{ old('motivo', $sancion->motivo ?? '') }}" required>
    </div>
    <div class="form-group col-md-2 d-flex align-items-center justify-content-center">
        <div class="custom-control custom-switch mt-4">
            {{-- Estado administrativo de la sanción. --}}
            <input type="hidden" name="activo" value="0">
            <input type="checkbox" name="activo" value="1" class="custom-control-input" id="activo" {{ old('activo', $sancion->activo ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="activo">Activo</label>
        </div>
    </div>
</div>

{{-- Segunda Línea: Días retraso (2) + Multa (2) + Fecha (3) + Estado (2) + Registrado por (3) = 12 --}}
<div class="row">
    <div class="form-group col-md-2">
        <label for="dias_retraso">Días de retraso</label>
        <input type="number" name="dias_retraso" id="dias_retraso" class="form-control" value="{{ old('dias_retraso', $sancion->dias_retraso ?? 0) }}" required>
    </div>
    <div class="form-group col-md-2">
        <label for="multa">Multa</label>
        <input type="number" step="0.01" name="multa" id="multa" class="form-control" value="{{ old('multa', $sancion->multa ?? 0) }}" required>
    </div>
    <div class="form-group col-md-3">
        <label for="fecha_sancion">Fecha sanción</label>
        <input type="date" name="fecha_sancion" id="fecha_sancion" class="form-control" value="{{ old('fecha_sancion', $sancion->fecha_sancion ?? '') }}" required>
    </div>
    <div class="form-group col-md-2">
        <label for="estado">Estado sanción</label>
        <select name="estado" id="estado" class="form-control" required>
            {{-- CLAVES EN MINÚSCULAS: Corrección del error de validación --}}
            @foreach(['pendiente' => 'Pendiente', 'pagada' => 'Pagada'] as $value => $label)
                <option value="{{ $value }}" {{ old('estado', $sancion->estado ?? 'pendiente') === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="registrado_por">Registrado por</label>
        <select name="registrado_por" id="registrado_por" class="form-control" required>
            <option value="">Selecciona un usuario</option>
            @foreach($registradores as $registrador)
                <option value="{{ $registrador->id }}" {{ (string) old('registrado_por', $sancion->registrado_por ?? '') === (string) $registrador->id ? 'selected' : '' }}>
                    {{ $registrador->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- Botonera de acciones --}}
<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('sanciones.index') }}" class="btn btn-secondary">Volver</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
