@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Vista de edicion de libros: usa el mismo formulario compartido que crear, pero enviando PUT. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Editar libro</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('libros.update', $libro) }}" method="POST">
                @method('PUT')
                @include('libros.form')
            </form>
        </div>
    </div>
</div>
@endsection
