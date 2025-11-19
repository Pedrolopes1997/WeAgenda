@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Médicos</h4>

    <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">Novo Médico</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CRM</th>
                <th>Email</th>
                <th>Especialidade</th>
                <th>Hospital</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicos as $medico)
                <tr>
                    <td>{{ $medico->nome }}</td>
                    <td>{{ $medico->crm }}</td>
                    <td>{{ $medico->email }}</td>
                    <td>{{ $medico->specialty->nome ?? '-' }}</td>
                    <td>{{ $medico->hospital->nome ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
