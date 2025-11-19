@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Agendamentos</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidade</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendamentos as $ag)
                <tr>
                    <td>{{ $ag->nome_paciente }}</td>
                    <td>{{ $ag->doctor->nome }}</td>
                    <td>{{ $ag->doctor->specialty->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($ag->data)->format('d/m/Y') }}</td>
                    <td>{{ $ag->hora }}</td>
                    <td>{{ ucfirst($ag->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
