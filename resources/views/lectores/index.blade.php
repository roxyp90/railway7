@extends('layouts.app')

@section('content')
<div class="pt-4">
    {{-- Encabezado del modulo de lectores / clientes. --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Lectores / clientes</h1>
        <a href="{{ route('lectores.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Nuevo lector
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabla principal del CRUD de lectores. --}}
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            {{-- AÑADIDO: Cabecera para el campo de auditoría --}}
                            <th>Registrado por</th>
                            <th>Activo</th>
                            <th class="text-center no-export">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lectores as $lector)
                            <tr>
                                <td>{{ $lector->id }}</td>
                                <td>{{ $lector->nombre }}</td>
                                <td>{{ $lector->correo }}</td>
                                <td>{{ $lector->telefono }}</td>
                                <td>{{ $lector->tipo }}</td>
                                {{-- AÑADIDO: Celda que muestra el nombre del administrador --}}
                                <td>{{ $lector->registrador->name ?? 'Sistema' }}</td>
                                <td>
                                    {{-- Cambio rapido de estado administrativo del lector. --}}
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input toggle-class"
                                            id="lector-{{ $lector->id }}"
                                            data-url="{{ route('lectores.estado', $lector) }}"
                                            {{ $lector->activo ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label estado-booleano {{ $lector->activo ? 'activo' : 'inactivo' }}" for="lector-{{ $lector->id }}">
                                            {{ $lector->activo ? 'Activo' : 'Inactivo' }}
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{-- Acciones disponibles desde el listado. --}}
                                    <a href="{{ route('lectores.show', $lector) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lectores.edit', $lector) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lectores.destroy', $lector) }}" method="POST" class="d-inline delete-form">
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
        // Activamos DataTables en espanol para mejorar busqueda y paginacion.
        window.initExportableDataTable('#example1', 'Lectores clientes');
    });
</script>
@endpush
