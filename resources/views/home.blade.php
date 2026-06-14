@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4">
    {{-- Resumen rapido para ver el estado general del sistema apenas se entra al dashboard. --}}
    {{-- TARJETAS DE RESUMEN RÁPIDO --}}
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalLibros }}</h3>
                    <p>Libros en Inventario</p>
                </div>
                <div class="icon"><i class="fas fa-book"></i></div>
                <a href="{{ route('libros.index') }}" class="small-box-footer">Ver inventario <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalUsuarios }}</h3>
                    <p>Usuarios Registrados</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $prestamosActivos }}</h3>
                    <p>Préstamos Activos</p>
                </div>
                <div class="icon"><i class="fas fa-hand-holding"></i></div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Tabla informativa para ver los ultimos movimientos de libros sin entrar al modulo completo. --}}
        {{-- TABLA DE ÚLTIMOS LIBROS --}}
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Últimos Libros Agregados</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimosLibros as $libro)
                            <tr>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->autor }}</td>
                                <td><span class="badge {{ strtolower($libro->estado) == 'disponible' ? 'badge-success' : 'badge-danger' }}">{{ $libro->estado }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Tabla informativa para revisar los prestamos mas recientes desde el panel principal. --}}
        {{-- TABLA DE ÚLTIMOS PRÉSTAMOS --}}
        <div class="col-md-6">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Préstamos Recientes</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimosPrestamos as $p)
                            <tr>
                                <td>{{ $p->nombre_usuario }}</td>
                                <td>{{ $p->fecha_prestamo }}</td>
                                <td><span class="badge badge-info">{{ $p->estado }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay préstamos registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
