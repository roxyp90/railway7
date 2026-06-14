@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">Detalle del prestamo</h2>
            <a href="{{ route('prestamos.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
        <div class="card-body">
            {{-- El detalle no contiene inputs: solo lectura tecnica y de auditoria. --}}
            <div class="row">
                <div class="col-lg-4">
                    <p><strong>ID:</strong> {{ $prestamo->id }}</p>
                    <p><strong>Lector:</strong> {{ $prestamo->usuario->nombre ?? 'No disponible' }}</p>
                    <p><strong>Correo lector:</strong> {{ $prestamo->usuario->correo ?? 'No disponible' }}</p>
                    <p><strong>Ejemplar:</strong> {{ $prestamo->ejemplar->codigo_inventario ?? 'No disponible' }}</p>
                    <p><strong>Libro:</strong> {{ $prestamo->ejemplar->libro->titulo ?? 'No disponible' }}</p>
                </div>
                <div class="col-lg-4">
                    <p><strong>Fecha prestamo:</strong> {{ $prestamo->fecha_prestamo }}</p>
                    <p><strong>Fecha devolucion:</strong> {{ $prestamo->fecha_devolucion ?? 'No registrada' }}</p>
                    <p><strong>Fecha entrega real:</strong> {{ $prestamo->fecha_entrega_real ?? 'No registrada' }}</p>
                    <p><strong>Estado negocio:</strong> {{ ucfirst($prestamo->estado) }}</p>
                    <p><strong>Activo:</strong> {{ $prestamo->activo ? 'Si' : 'No' }}</p>
                </div>
                <div class="col-lg-4">
                    <p><strong>Registrado por:</strong> {{ $prestamo->registrador->name ?? 'Sistema' }}</p>
                    <p><strong>Creado el:</strong> {{ optional($prestamo->created_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                    <p><strong>Actualizado el:</strong> {{ optional($prestamo->updated_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                    <p><strong>ID lector:</strong> {{ $prestamo->usuario_id }}</p>
                    <p><strong>ID ejemplar:</strong> {{ $prestamo->ejemplar_id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
