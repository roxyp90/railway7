@extends('layouts.app')

@section('content')
<div class="pt-4">
    {{-- Encabezado del modulo con acceso directo al formulario de creacion. --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Usuarios del sistema</h1>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Nuevo usuario
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabla principal del CRUD de usuarios. Aqui se listan, editan, activan y eliminan registros. --}}
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th class="text-center no-export">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    {{-- Switch para activar / desactivar sin salir del listado. --}}
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input toggle-class"
                                            id="usuario-{{ $usuario->id }}"
                                            data-url="{{ route('usuarios.estado', $usuario) }}"
                                            {{ $usuario->activo ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label estado-booleano {{ $usuario->activo ? 'activo' : 'inactivo' }}" for="usuario-{{ $usuario->id }}">
                                            {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{-- Botones rapidos para editar o eliminar el usuario seleccionado. --}}
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline delete-form">
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
        // Convertimos la tabla en DataTable usando la configuracion global en espanol.
        window.initExportableDataTable('#example1', 'Usuarios del sistema');
    });
</script>
@endpush
