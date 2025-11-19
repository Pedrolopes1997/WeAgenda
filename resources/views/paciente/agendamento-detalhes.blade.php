@extends('paciente.layout')

@section('content')
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes da Consulta - WeAgenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<section class="container mt-5">
  <h2 class="mb-4">Detalhes da Consulta</h2>

  <div class="card shadow-sm">
    <div class="card-body">
      <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</p>
      <p><strong>Hora:</strong> {{ $agendamento->hora }}</p>
      <p><strong>Médico:</strong> {{ \App\Models\Doctor::find($agendamento->doctor_id)?->nome ?? 'Não encontrado' }}</p>
      <p><strong>Status:</strong> {{ ucfirst($agendamento->status) }}</p>
      <p><strong>Paciente:</strong> {{ $agendamento->nome_paciente }}</p>
        @if($agendamento->status === 'confirmado')
          <div class="mt-3">
            <a href="{{ url('/paciente/agendamento/'.$agendamento->id.'/reagendar') }}" class="btn btn-warning">Reagendar Consulta</a>
          </div>
        @endif
    </div>
  </div>

  <div class="mt-4">
    <a href="/paciente/agendamentos" class="btn btn-secondary">Voltar para Meus Agendamentos</a>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection