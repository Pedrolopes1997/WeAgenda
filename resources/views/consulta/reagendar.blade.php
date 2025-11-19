@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="text-center mb-4">Reagendar Consulta</h3>

    <form method="POST" action="{{ route('consulta.salvarReagendamento', $agendamento->id) }}" class="mx-auto" style="max-width: 500px;">
        @csrf

        <div class="mb-3">
            <label>Médico</label>
            <select name="doctor_id" class="form-control" required>
                <option value="">Selecione o médico</option>
                @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}">{{ $medico->nome }} - {{ $medico->specialty->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Data</label>
            <input type="date" name="data" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Hora</label>
            <input type="time" name="hora" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100 mt-3">Confirmar Novo Agendamento</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('consulta.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
@endsection
