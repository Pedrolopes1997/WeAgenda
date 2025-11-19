@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Especialidades</h4>

    <a href="{{ route('specialties.create') }}" class="btn btn-primary mb-3">Nova Especialidade</a>

    <ul class="list-group">
        @foreach ($especialidades as $especialidade)
            <li class="list-group-item">{{ $especialidade->nome }}</li>
        @endforeach
    </ul>
</div>
@endsection
