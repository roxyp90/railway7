@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">Detalle de la sancion</h2>
            <a href="{{ route('sanciones.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
        <div class="card-body">
            {{-- Vista de consulta: se muestran campos tecnicos y auditoria sin controles editables. --}}
            <div class="row">
                <div class="col-lg-4">
                    <p><strong>ID:</strong> {{ $sancion->id }}</p>
                    <p><strong>Lector:</strong> {{ $sancion->usuario->nombre ?? 'No disponible' }}</p>
                    <p><strong>Correo lector:</strong> {{ $sancion->usuario->correo ?? 'No disponible' }}</p>
                    <p><strong>Prestamo:</strong> #{{ $sancion->prestamo_id }}</p>
                    <p><strong>Libro relacionado:</strong> {{ $sancion->prestamo->ejemplar->libro->titulo ?? 'No disponible' }}</p>
                </div>
                <div class="col-lg-4">
                    <p><strong>Motivo:</strong> {{ $sancion->motivo }}</p>
                    <p><strong>Dias de retraso:</strong> {{ $sancion->dias_retraso }}</p>
                    <p><strong>Multa:</strong> ${{ number_format($sancion->multa, 2) }}</p>
                    <p><strong>Fecha sancion:</strong> {{ $sancion->fecha_sancion }}</p>
                    <p><strong>Estado negocio:</strong> {{ ucfirst($sancion->estado) }}</p>
                </div>
                <div class="col-lg-4">
                    <p><strong>Activo:</strong> {{ $sancion->activo ? 'Si' : 'No' }}</p>
                    <p><strong>Registrado por:</strong> {{ $sancion->registrador->name ?? 'Sistema' }}</p>
                    <p><strong>Creado el:</strong> {{ optional($sancion->created_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                    <p><strong>Actualizado el:</strong> {{ optional($sancion->updated_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                    <p><strong>ID lector:</strong> {{ $sancion->usuario_id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
