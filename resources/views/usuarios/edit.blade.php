@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Pantalla para editar usuarios existentes. El metodo PUT deja claro que es una actualizacion. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Editar usuario</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                @method('PUT')
                @include('usuarios.form')
            </form>
        </div>
    </div>
</div>
@endsection
