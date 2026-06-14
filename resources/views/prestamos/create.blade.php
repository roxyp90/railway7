@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Alta de prestamos. El formulario compartido recibe lectores y ejemplares disponibles. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Crear préstamo</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('prestamos.store') }}" method="POST">
                @include('prestamos.form')
            </form>
        </div>
    </div>
</div>
@endsection
