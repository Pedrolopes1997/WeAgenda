@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Agendamentos</h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('appointments.export', request()->all()) }}" class="btn btn-success">
            Exportar Excel
        </a>
    
        <a href="{{ route('appointments.exportPdf', request()->all()) }}" class="btn btn-danger">
            Exportar PDF
        </a>
    </div>
    
    <div class="card p-4 mb-4">
        <form method="GET" action="{{ route('appointments.index') }}">
            <div class="row">
                <div class="col-md-3">
                    <label>Médico</label>
                    <select name="doctor_id" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($medicos as $medico)
                            <option value="{{ $medico->id }}" {{ request('doctor_id') == $medico->id ? 'selected' : '' }}>
                                {{ $medico->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-3">
                    <label>Especialidade</label>
                    <select name="specialty_id" class="form-control">
                        <option value="">Todas</option>
                        @foreach ($especialidades as $especialidade)
                            <option value="{{ $especialidade->id }}" {{ request('specialty_id') == $especialidade->id ? 'selected' : '' }}>
                                {{ $especialidade->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-2">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">Todos</option>
                        <option value="agendado" {{ request('status') == 'agendado' ? 'selected' : '' }}>Agendado</option>
                        <option value="confirmado" {{ request('status') == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                        <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
    
                <div class="col-md-2">
                    <label>Data Início</label>
                    <input type="date" name="data_inicio" value="{{ request('data_inicio') }}" class="form-control">
                </div>
    
                <div class="col-md-2">
                    <label>Data Fim</label>
                    <input type="date" name="data_fim" value="{{ request('data_fim') }}" class="form-control">
                </div>
    
                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Limpar</a>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidade</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Status</th>
                <th>Ações</th>
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
                    <td>
                        @if($ag->status == 'agendado')
                            <span class="badge bg-warning text-dark">Agendado</span>
                        @elseif($ag->status == 'confirmado')
                            <span class="badge bg-success">Confirmado</span>
                        @elseif($ag->status == 'cancelado')
                            <span class="badge bg-danger">Cancelado</span>
                        @endif
                    </td>
                    <td>
                        @if($ag->status == 'agendado')
                            <form action="{{ route('appointments.confirm', $ag->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Confirmar</button>
                            </form>
                            <form action="{{ route('appointments.cancel', $ag->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Cancelar</button>
                            </form>
                        @else
                            <em>Sem ações</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $agendamentos->appends(request()->except('page'))->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
