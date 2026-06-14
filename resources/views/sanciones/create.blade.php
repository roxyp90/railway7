@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Alta de sanciones con reutilizacion del partial para mantener el formulario centralizado. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Crear sanción</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('sanciones.store') }}" method="POST">
                @include('sanciones.form')
            </form>
        </div>
    </div>
</div>
@endsection
