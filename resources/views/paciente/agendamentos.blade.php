@extends('paciente.layout')

@section('content')
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meus Agendamentos - WeAgenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<section class="container mt-5">
  <h2 class="mb-4">Meus Agendamentos</h2>
  
    @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif

  @if($agendamentos->isEmpty())
    <div class="alert alert-info">
      Você ainda não possui agendamentos.
    </div>
  @else
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th>Data</th>
            <th>Hora</th>
            <th>Médico</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($agendamentos as $agendamento)
            <tr>
              <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
              <td>{{ $agendamento->hora }}</td>
              <td>{{ $agendamento->medico_nome }}</td>
              <td>{{ ucfirst($agendamento->status) }}</td>
              <td>@if($agendamento->status === 'confirmado')
                <form action="{{ url('/paciente/agendamentos/'.$agendamento->id.'/cancelar') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar este agendamento?');">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger">Cancelar</button>
                </form>
              @else
                -
              @endif
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif

  <div class="mt-4">
    <a href="/paciente/dashboard" class="btn btn-secondary">Voltar ao Dashboard</a>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection