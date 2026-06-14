@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Pantalla para crear usuarios nuevos reutilizando el partial usuarios.form. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Crear usuario</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @include('usuarios.form')
            </form>
        </div>
    </div>
</div>
@endsection
