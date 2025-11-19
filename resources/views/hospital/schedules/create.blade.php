@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Novo Horário</h4>

    <form method="POST" action="{{ route('schedules.store') }}">
        @csrf
        <div class="mb-3">
            <label>Médico</label>
            <select name="doctor_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Dia da Semana</label>
            <select name="dia_semana" class="form-control" required>
                <option value="">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="0">Domingo</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Hora</label>
            <input type="time" name="hora" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
