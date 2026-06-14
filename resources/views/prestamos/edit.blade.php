@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Edicion de prestamos ya existentes. Se envia PUT porque actualiza un registro guardado. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Editar préstamo</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('prestamos.update', $prestamo) }}" method="POST">
                @method('PUT')
                @include('prestamos.form')
            </form>
        </div>
    </div>
</div>
@endsection
