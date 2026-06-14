@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Edicion de sanciones existentes usando el mismo formulario del create. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Editar sanción</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('sanciones.update', $sancion) }}" method="POST">
                @method('PUT')
                @include('sanciones.form')
            </form>
        </div>
    </div>
</div>
@endsection
