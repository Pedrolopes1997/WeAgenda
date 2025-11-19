@extends('paciente.layout')

@section('content')
<div class="container">
  <h2 class="mb-5 text-center">Bem-vindo, {{ auth()->guard('paciente')->user()->nome }}!</h2>

  <div class="row g-4">

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <i class="bi bi-calendar-check display-4 text-primary"></i>
          <h5 class="card-title mt-3">Consultas Confirmadas</h5>
          <p class="display-6 text-success">{{ $agendamentosConfirmados }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <i class="bi bi-calendar-x display-4 text-danger"></i>
          <h5 class="card-title mt-3">Consultas Canceladas</h5>
          <p class="display-6 text-danger">{{ $agendamentosCancelados }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <i class="bi bi-calendar-event display-4 text-info"></i>
          <h5 class="card-title mt-3">Próxima Consulta</h5>
          @if($proximaConsulta)
            <p class="mb-1"><strong>Data:</strong> {{ \Carbon\Carbon::parse($proximaConsulta->data)->format('d/m/Y') }}</p>
            <p class="mb-1"><strong>Hora:</strong> {{ $proximaConsulta->hora }}</p>
            <p class="mb-1"><strong>Médico:</strong> {{ \App\Models\Doctor::find($proximaConsulta->doctor_id)?->nome ?? 'Não encontrado' }}</p>
            <a href="{{ url('/paciente/agendamento/'.$proximaConsulta->id) }}" class="btn btn-outline-primary btn-sm mt-2">Ver Detalhes</a>
          @else
            <p class="text-muted">Nenhuma consulta futura agendada.</p>
          @endif
        </div>
      </div>
    </div>

  </div>

  <div class="mt-5 d-flex justify-content-center gap-3">
    <a href="/paciente/agendar" class="btn btn-primary btn-lg">Agendar Nova Consulta</a>
    <a href="/paciente/agendamentos" class="btn btn-outline-primary btn-lg">Ver Meus Agendamentos</a>
  </div>
</div>
@endsection
