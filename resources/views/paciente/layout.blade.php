<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WeAgenda - Paciente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      color: #333;
    }
    .navbar {
      background-color: #007BFF;
    }
    .navbar-brand, .nav-link, .btn-outline-light {
      color: #ffffff !important;
    }
    .btn-primary {
      background-color: #007BFF;
      border-color: #007BFF;
    }
    .btn-success {
      background-color: #28A745;
      border-color: #28A745;
    }
    .btn-outline-primary {
      border-color: #007BFF;
      color: #007BFF;
    }
    .btn-outline-primary:hover {
      background-color: #007BFF;
      color: #ffffff;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/paciente/dashboard">WeAgenda</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPaciente" aria-controls="navbarPaciente" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarPaciente">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/paciente/dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/paciente/agendar">Agendar Consulta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/paciente/agendamentos">Meus Agendamentos</a>
        </li>
        <li class="nav-item">
          <form action="/paciente/logout" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm ms-3">Sair</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
