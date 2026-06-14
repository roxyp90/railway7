@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">Detalle del lector</h2>
            <a href="{{ route('lectores.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
        <div class="card-body">
            {{-- Vista de solo lectura: no usamos inputs para evitar cambios accidentales. --}}
            <div class="row">
                <div class="col-lg-6">
                    <p><strong>ID:</strong> {{ $lector->id }}</p>
                    <p><strong>Nombre:</strong> {{ $lector->nombre }}</p>
                    <p><strong>Correo:</strong> {{ $lector->correo }}</p>
                    <p><strong>Telefono:</strong> {{ $lector->telefono ?? 'No registrado' }}</p>
                    <p><strong>Direccion:</strong> {{ $lector->direccion ?? 'No registrada' }}</p>
                </div>
                <div class="col-lg-6">
                    <p><strong>Tipo:</strong> {{ $lector->tipo }}</p>
                    <p><strong>Estado:</strong> {{ ucfirst($lector->estado) }}</p>
                    <p><strong>Activo:</strong> {{ $lector->activo ? 'Si' : 'No' }}</p>
                    <p><strong>Registrado por:</strong> {{ $lector->registrador->name ?? 'Sistema' }}</p>
                    <p><strong>Creado el:</strong> {{ optional($lector->created_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                    <p><strong>Actualizado el:</strong> {{ optional($lector->updated_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-6">
                    <p><strong>Total prestamos:</strong> {{ $lector->prestamos->count() }}</p>
                </div>
                <div class="col-lg-6">
                    <p><strong>Total sanciones:</strong> {{ $lector->sanciones->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
