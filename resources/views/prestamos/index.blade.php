@extends('layouts.app')

@section('content')
<div class="pt-4">
    {{-- Encabezado del modulo de prestamos con acceso al alta de un nuevo movimiento. --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Préstamos</h1>
        <a href="{{ route('prestamos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Nuevo préstamo
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabla del CRUD de prestamos: mezcla datos del lector, ejemplar y estado operativo. --}}
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lector</th>
                            <th>Ejemplar</th>
                            <th>Libro</th>
                            <th>Fecha préstamo</th>
                            <th>Fecha devolución</th>
                            <th>Estado negocio</th>
                            {{-- AÑADIDO: Cabecera para auditoría --}}
                            <th>Registrado por</th>
                            <th>Activo</th>
                            <th class="text-center no-export">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->id }}</td>
                                <td>{{ $prestamo->usuario->nombre ?? 'N/A' }}</td>
                                <td>{{ $prestamo->ejemplar->codigo_inventario ?? 'N/A' }}</td>
                                <td>{{ $prestamo->ejemplar->libro->titulo ?? 'N/A' }}</td>
                                <td>{{ $prestamo->fecha_prestamo }}</td>
                                <td>{{ $prestamo->fecha_devolucion ?? 'N/A' }}</td>
                                <td>
                                    {{-- Este select cambia el estado de negocio real del prestamo: prestado o devuelto. --}}
                                    <select class="form-control form-control-sm select-estado-negocio" 
                                            data-url="{{ route('prestamos.estadoNegocio', $prestamo) }}"
                                            style="background-color: {{ $prestamo->estado === 'devuelto' ? '#d4edda' : '#fff3cd' }}; font-weight: bold; border-radius: 15px;">
                                        <option value="prestado" {{ $prestamo->estado === 'prestado' ? 'selected' : '' }}>Prestado</option>
                                        <option value="devuelto" {{ $prestamo->estado === 'devuelto' ? 'selected' : '' }}>Devuelto</option>
                                    </select>
                                </td>
                                {{-- CORREGIDO AQUÍ: Muestra el campo 'name' del administrador real --}}
                                <td>{{ $prestamo->registrador->name ?? 'Sistema' }}</td>
                                <td>
                                    {{-- Estado administrativo activo / inactivo del registro. --}}
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input toggle-class"
                                            id="prestamo-{{ $prestamo->id }}"
                                            data-url="{{ route('prestamos.estado', $prestamo) }}"
                                            {{ $prestamo->activo ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label estado-booleano {{ $prestamo->activo ? 'activo' : 'inactivo' }}" for="prestamo-{{ $prestamo->id }}">
                                            {{ $prestamo->activo ? 'Activo' : 'Inactivo' }}
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{-- Acciones clasicas del CRUD desde la misma fila. --}}
                                    <a href="{{ route('prestamos.show', $prestamo) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('prestamos.edit', $prestamo) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST" class="d-inline delete-form">
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
        window.initExportableDataTable('#example1', 'Prestamos');

        // Cambio por AJAX del estado de negocio sin recargar toda la pagina.
        $('.select-estado-negocio').on('change', function() {
            let estado = $(this).val();
            let url = $(this).data('url');
            let select = $(this);

            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    estado: estado
                },
                success: function(response) {
                    // Ajustamos el color para que visualmente se entienda el nuevo estado.
                    if(estado === 'devuelto') {
                        select.css('background-color', '#d4edda');
                    } else {
                        select.css('background-color', '#fff3cd');
                    }
                    console.log(response.message);
                },
                error: function() {
                    alert('Error al actualizar el estado del préstamo.');
                }
            });
        });
    });
</script>
@endpush
