@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Vista de alta de libros: reutiliza el partial libros.form para mantener una sola version del formulario. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Crear libro</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('libros.store') }}" method="POST">
                @include('libros.form')
            </form>
        </div>
    </div>
</div>
@endsection
