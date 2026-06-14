{{-- Formulario base reutilizado para crear y editar libros en dos líneas --}}
@csrf

{{-- Primera Línea: Título (6) y Autor (6) = 12 --}}
<div class="row">
    <div class="form-group col-md-6">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $libro->titulo ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="autor">Autor</label>
        <input type="text" name="autor" id="autor" class="form-control" value="{{ old('autor', $libro->autor ?? '') }}" required>
    </div>
</div>

{{-- Segunda Línea: Editorial (3) + Año (2) + Estado (2) + Registrado por (3) + Activo (2) = 12 --}}
<div class="row">
    <div class="form-group col-md-3">
        <label for="editorial">Editorial</label>
        <input type="text" name="editorial" id="editorial" class="form-control" value="{{ old('editorial', $libro->editorial ?? '') }}" required>
    </div>
    <div class="form-group col-md-2">
        <label for="anio">Año</label>
        <input type="number" name="anio" id="anio" class="form-control" value="{{ old('anio', $libro->anio ?? '') }}" required>
    </div>
    <div class="form-group col-md-2">
        <label for="estado">Estado libro</label>
        <select name="estado" id="estado" class="form-control" required>
            @foreach(['disponible' => 'Disponible', 'prestado' => 'Prestado'] as $value => $label)
                <option value="{{ $value }}" {{ old('estado', $libro->estado ?? 'disponible') === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="registrado_por">Registrado por</label>
        <select name="registrado_por" id="registrado_por" class="form-control" required>
            <option value="">Selecciona un usuario</option>
            @foreach($registradores as $registrador)
                <option value="{{ $registrador->id }}" {{ (string) old('registrado_por', $libro->registrado_por ?? '') === (string) $registrador->id ? 'selected' : '' }}>
                    {{ $registrador->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2 d-flex align-items-center justify-content-center">
        <div class="custom-control custom-switch mt-4">
            {{-- El hidden garantiza enviar 0 cuando el switch venga apagado. --}}
            <input type="hidden" name="activo" value="0">
            <input type="checkbox" name="activo" value="1" class="custom-control-input" id="activo" {{ old('activo', $libro->activo ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="activo">Activo</label>
        </div>
    </div>
</div>

{{-- Botonera de acciones --}}
<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('libros.index') }}" class="btn btn-secondary">Volver</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
