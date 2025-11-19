@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Horários Cadastrados</h4>

    <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">Novo Horário</a>

    <table class="table">
        <thead>
            <tr>
                <th>Médico</th>
                <th>Dia da Semana</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $h)
                <tr>
                    <td>{{ $h->doctor->nome }}</td>
                    <td>{{ ucfirst($h->dia_semana) }}</td>
                    <td>{{ substr($h->hora, 0, 5) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
