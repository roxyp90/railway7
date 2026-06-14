@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="card">
        {{-- Edicion de lectores con el mismo partial para no duplicar logica de campos. --}}
        <div class="card-header">
            <h2 class="card-title mb-0">Editar lector</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('lectores.update', $lector) }}" method="POST">
                @method('PUT')
                @include('lectores.form')
            </form>
        </div>
    </div>
</div>
@endsection
