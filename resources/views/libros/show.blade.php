@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">Detalle del libro</h2>
            <a href="{{ route('libros.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
        <div class="card-body">
            {{-- Vista informativa: todo se muestra como texto para conservar el registro intacto. --}}
            <div class="row">
                <div class="col-lg-4">
                    @if($libro->imagen)
                        <p><strong>Portada:</strong></p>
                        <img src="{{ asset($libro->imagen) }}" alt="Portada del libro" class="img-fluid rounded border" style="max-height: 260px; object-fit: cover;">
                    @else
                        <p><strong>Portada:</strong> Sin imagen registrada</p>
                    @endif
                </div>
                <div class="col-lg-4">
                    <p><strong>ID:</strong> {{ $libro->id }}</p>
                    <p><strong>Titulo:</strong> {{ $libro->titulo }}</p>
                    <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                    <p><strong>Editorial:</strong> {{ $libro->editorial }}</p>
                    <p><strong>Anio:</strong> {{ $libro->anio }}</p>
                </div>
                <div class="col-lg-4">
                    <p><strong>Estado libro:</strong> {{ ucfirst($libro->estado) }}</p>
                    <p><strong>Activo:</strong> {{ $libro->activo ? 'Si' : 'No' }}</p>
                    <p><strong>Registrado por:</strong> {{ $libro->registrador->name ?? 'Sistema' }}</p>
                    <p><strong>Creado el:</strong> {{ optional($libro->created_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                    <p><strong>Actualizado el:</strong> {{ optional($libro->updated_at)->format('Y-m-d H:i') ?? 'Sin fecha' }}</p>
                    <p><strong>Total ejemplares:</strong> {{ $libro->ejemplares->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
