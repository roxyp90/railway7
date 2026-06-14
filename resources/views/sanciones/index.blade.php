@extends('layouts.app')

@section('content')
<div class="pt-4">
    {{-- Encabezado del modulo de sanciones. --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Sanciones</h1>
        <a href="{{ route('sanciones.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Nueva sanción
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabla del CRUD de sanciones con estado de negocio y estado administrativo separados. --}}
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lector</th>
                            <th>Préstamo</th>
                            <th>Motivo</th>
                            <th>Días</th>
                            <th>Multa</th>
                            <th>Estado negocio</th>
                            {{-- AÑADIDO: Cabecera para auditoría --}}
                            <th>Registrado por</th>
                            <th>Activo</th>
                            <th class="text-center no-export">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sanciones as $sancion)
                            <tr>
                                <td>{{ $sancion->id }}</td>
                                <td>{{ $sancion->usuario->nombre ?? 'N/A' }}</td>
                                <td>#{{ $sancion->prestamo_id }}</td>
                                <td>{{ $sancion->motivo }}</td>
                                <td>{{ $sancion->dias_retraso }}</td>
                                <td>${{ number_format($sancion->multa, 2) }}</td>
                                <td>
                                    {{-- Estado de negocio de la sancion: pendiente o pagada. --}}
                                    <select class="form-control form-control-sm select-sancion-negocio" 
                                            data-url="{{ route('sanciones.estadoNegocio', $sancion) }}"
                                            style="background-color: {{ $sancion->estado === 'pagada' ? '#d4edda' : '#f8d7da' }}; font-weight: bold; border-radius: 15px;">
                                        <option value="pendiente" {{ $sancion->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="pagada" {{ $sancion->estado === 'pagada' ? 'selected' : '' }}>Pagada</option>
                                    </select>
                                </td>
                                {{-- CORREGIDO AQUÍ: Muestra el campo 'name' del administrador real --}}
                                <td>{{ $sancion->registrador->name ?? 'Sistema' }}</td>
                                <td>
                                    {{-- Estado activo / inactivo para control administrativo del registro. --}}
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input toggle-class"
                                            id="sancion-{{ $sancion->id }}"
                                            data-url="{{ route('sanciones.estado', $sancion) }}"
                                            {{ $sancion->activo ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label estado-booleano {{ $sancion->activo ? 'activo' : 'inactivo' }}" for="sancion-{{ $sancion->id }}">
                                            {{ $sancion->activo ? 'Activo' : 'Inactivo' }}
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{-- Acciones del CRUD para editar o eliminar desde la tabla. --}}
                                    <a href="{{ route('sanciones.show', $sancion) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('sanciones.edit', $sancion) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('sanciones.destroy', $sancion) }}" method="POST" class="d-inline delete-form">
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
        window.initExportableDataTable('#example1', 'Sanciones');

        // Cambio por AJAX del estado de negocio de la sancion.
        $('.select-sancion-negocio').on('change', function() {
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
                    // Refuerzo visual rapido del estado seleccionado.
                    if(estado === 'pagada') {
                        select.css('background-color', '#d4edda');
                    } else {
                        select.css('background-color', '#f8d7da');
                    }
                },
                error: function() {
                    alert('Error al actualizar la sanción.');
                }
            });
        });
    });
</script>
@endpush
