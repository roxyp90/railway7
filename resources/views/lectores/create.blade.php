@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Alta de lectores / clientes usando el formulario reutilizable del modulo. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Crear lector</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('lectores.store') }}" method="POST">
                @include('lectores.form')
            </form>
        </div>
    </div>
</div>
@endsection
