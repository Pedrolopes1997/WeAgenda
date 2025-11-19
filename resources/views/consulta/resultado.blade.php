@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="text-center mb-4">Seus Agendamentos</h3>

    {{-- Próximos Agendamentos --}}
    <h4 class="mt-4 mb-3">Próximos Agendamentos</h4>

    @if($agendamentosFuturos->count())
        <div class="row justify-content-center">
            @foreach ($agendamentosFuturos as $agendamento)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $agendamento->doctor->nome }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $agendamento->doctor->specialty->nome }}</h6>
                    
                            <p class="card-text mt-3">
                                <strong>Data:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}<br>
                                <strong>Hora:</strong> {{ substr($agendamento->hora,0,5) }}<br>
                                <strong>Status:</strong> 
                                @if($agendamento->status == 'agendado')
                                    <span class="badge bg-warning text-dark">Agendado</span>
                                @elseif($agendamento->status == 'confirmado')
                                    <span class="badge bg-success">Confirmado</span>
                                @elseif($agendamento->status == 'cancelado')
                                    <span class="badge bg-danger">Cancelado</span>
                                @elseif($agendamento->status == 'reagendado')
                                    <span class="badge bg-primary">Reagendado</span>
                                @else
                                    <span class="badge bg-secondary">Outro</span>
                                @endif
                            </p>
                    
                            {{-- Botões de ação --}}
                            @if($agendamento->status == 'agendado')
                                <form method="POST" action="{{ route('consulta.cancelar', $agendamento->id) }}" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">Cancelar Agendamento</button>
                                </form>
                    
                                <a href="{{ route('consulta.reagendar', $agendamento->id) }}" class="btn btn-warning w-100">Reagendar</a>
                    
                            @elseif($agendamento->status == 'cancelado')
                                <a href="{{ route('consulta.reagendar', $agendamento->id) }}" class="btn btn-warning w-100">Reagendar</a>
                    
                            @else
                                <button class="btn btn-secondary w-100 mt-2" disabled>Agendamento Finalizado</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">Nenhum agendamento futuro encontrado.</div>
    @endif

    {{-- Agendamentos Anteriores --}}
    <h4 class="mt-5 mb-3">Agendamentos Anteriores</h4>

    @if($agendamentosPassados->count())
        <div class="row justify-content-center">
            @foreach ($agendamentosPassados as $agendamento)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">{{ $agendamento->doctor->nome }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $agendamento->doctor->specialty->nome }}</h6>
                            <p class="card-text mt-3">
                                <strong>Data:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}<br>
                                <strong>Hora:</strong> {{ substr($agendamento->hora,0,5) }}<br>
                                <strong>Status:</strong> 
                                @if($agendamento->status == 'agendado')
                                    <span class="badge bg-warning text-dark">Agendado</span>
                                @elseif($agendamento->status == 'confirmado')
                                    <span class="badge bg-success">Confirmado</span>
                                @elseif($agendamento->status == 'cancelado')
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </p>

                            <button class="btn btn-secondary w-100 mt-2" disabled>Agendamento Finalizado</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">Nenhum agendamento anterior encontrado.</div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('consulta.index') }}" class="btn btn-primary">Nova Consulta</a>
    </div>
</div>
@endsection
