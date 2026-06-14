@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Inventario de libros</h1>
        {{-- Botón para ir al formulario de creación del módulo de libros. --}}
        <a href="{{ route('libros.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Nuevo libro
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            {{-- Esta columna la agregué para mostrar una miniatura del libro en el listado. --}}
                            <th class="no-export">Portada</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Año</th>
                            <th>Estado libro</th>
                            <th>Activo</th>
                            <th>Registrado por</th>
                            <th class="text-center no-export">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($libros as $libro)
                            <tr>
                                <td>{{ $libro->id }}</td>
                                <td class="text-center">
                                    {{-- Si el libro tiene imagen guardada, se muestra en pequeño en la tabla. --}}
                                    @if($libro->imagen)
                                        <img src="{{ asset($libro->imagen) }}" 
                                             alt="Portada" 
                                             style="width: 50px; height: 70px; object-fit: cover; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    @else
                                        {{-- Si no hay imagen, dejo un bloque visual por defecto. --}}
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 70px; border-radius: 4px; border: 1px dashed #ddd;">
                                            <i class="fas fa-book text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->autor }}</td>
                                <td>{{ $libro->editorial }}</td>
                                <td>{{ $libro->anio }}</td>
                                <td><span class="badge badge-{{ $libro->estado === 'disponible' ? 'success' : 'warning' }}">{{ ucfirst($libro->estado) }}</span></td>
                                <td>
                                    {{-- Este switch cambia el estado activo desde la tabla y sí impacta la BD. --}}
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input toggle-class"
                                            id="libro-{{ $libro->id }}"
                                            data-url="{{ route('libros.estado', $libro) }}"
                                            {{ $libro->activo ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label estado-booleano {{ $libro->activo ? 'activo' : 'inactivo' }}" for="libro-{{ $libro->id }}">
                                            {{ $libro->activo ? 'Activo' : 'Inactivo' }}
                                        </label>
                                    </div>
                                </td>
                                {{-- CORREGIDO AQUÍ: Cambiado 'nombre' por 'name' para los administradores reales --}}
                                <td>{{ $libro->registrador->name ?? 'Sistema' }}</td>
                                <td class="text-center">
                                    {{-- Editar abre el formulario del recurso actual. --}}
                                    <a href="{{ route('libros.show', $libro) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('libros.edit', $libro) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- Eliminar manda DELETE al controlador y borra el registro también en phpMyAdmin. --}}
                                    <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        // Inicializo DataTables en español para este listado.
        window.initExportableDataTable('#example1', 'Inventario de libros');
    });
</script>
@endpush
