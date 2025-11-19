@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Novo Médico</h4>

    <form method="POST" action="{{ route('doctors.store') }}">
        @csrf
        <input type="hidden" name="hospital_id" value="{{ $hospital->id }}">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CRM</label>
            <input type="text" name="crm" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Especialidade</label>
            <select name="specialty_id" class="form-control" required>
                <option value="">Selecione...</option>
                @foreach ($especialidades as $esp)
                    <option value="{{ $esp->id }}">{{ $esp->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
