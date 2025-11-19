@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Nova Especialidade</h4>

    <form method="POST" action="{{ route('specialties.store') }}">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Especialidade</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('specialties.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
