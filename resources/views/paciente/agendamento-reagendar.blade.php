@extends('paciente.layout')

@section('content')
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reagendar Consulta - WeAgenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<section class="container mt-5">
  <h2 class="mb-4">Reagendar Consulta</h2>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <p><strong>Médico:</strong> {{ \App\Models\Doctor::find($agendamento->doctor_id)?->nome ?? 'Não encontrado' }}</p>
      <p><strong>Data Atual:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</p>
      <p><strong>Hora Atual:</strong> {{ $agendamento->hora }}</p>
    </div>
  </div>

  <form method="POST" action="/paciente/agendamento/{{ $agendamento->id }}/reagendar">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Nova Data</label>
        <input type="date" name="data" id="data" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Nova Hora</label>
        <select name="hora" id="hora" class="form-select" required>
          <option value="">Selecione uma data primeiro</option>
        </select>
      </div>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Confirmar Reagendamento</button>
    </div>
  </form>

  <div class="mt-4">
    <a href="/paciente/dashboard" class="btn btn-secondary">Cancelar e Voltar</a>
  </div>
</section>

<script>
  document.getElementById('data').addEventListener('change', function() {
    var dataSelecionada = this.value;
    var doctorId = {{ $agendamento->doctor_id }};
    var horaSelect = document.getElementById('hora');
    horaSelect.innerHTML = '<option>Carregando...</option>';

    if (doctorId && dataSelecionada) {
      axios.get(`/api/horarios-disponiveis/${doctorId}/${dataSelecionada}`)
        .then(function(response) {
          horaSelect.innerHTML = '<option value="">Selecione</option>';
          response.data.forEach(function(hora) {
            horaSelect.innerHTML += `<option value="${hora}">${hora}</option>`;
          });
        });
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection