@extends('paciente.layout')

@section('content')
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendar Nova Consulta - WeAgenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>


<section class="container mt-5">
  <h2 class="mb-4">Agendar Nova Consulta</h2>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="/paciente/agendar">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Especialidade</label>
        <select name="specialty_id" id="specialty_id" class="form-select" required>
          <option value="">Selecione</option>
          @foreach($especialidades as $especialidade)
            <option value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label>Médico</label>
        <select name="doctor_id" id="doctor_id" class="form-select" required>
          <option value="">Selecione uma especialidade primeiro</option>
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label>Data</label>
        <input type="date" name="data" id="data" class="form-control" required>
      </div>

      <div class="col-md-6 mb-3">
        <label>Hora</label>
        <select name="hora" id="hora" class="form-select" required>
          <option value="">Selecione um médico e data</option>
        </select>
      </div>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Agendar Consulta</button>
    </div>
  </form>

  <div class="mt-4">
    <a href="/paciente/dashboard" class="btn btn-secondary">Voltar ao Dashboard</a>
  </div>
</section>

<script>
  document.getElementById('specialty_id').addEventListener('change', function() {
    var specialtyId = this.value;
    var doctorSelect = document.getElementById('doctor_id');
    doctorSelect.innerHTML = '<option>Carregando...</option>';

    axios.get('/api/medicos-especialidade/' + specialtyId)
      .then(function(response) {
        doctorSelect.innerHTML = '<option value="">Selecione</option>';
        response.data.forEach(function(medico) {
          doctorSelect.innerHTML += `<option value="${medico.id}">${medico.nome}</option>`;
        });
      });
  });

  document.getElementById('doctor_id').addEventListener('change', carregarHorarios);
  document.getElementById('data').addEventListener('change', carregarHorarios);

  function carregarHorarios() {
    var doctorId = document.getElementById('doctor_id').value;
    var dataSelecionada = document.getElementById('data').value;
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
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection