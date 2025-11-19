<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Painel de Controle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header Admin -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/admin/dashboard">WeAgenda Admin</a>
    <div class="d-flex">
      <a href="/logout" class="btn btn-outline-danger">Sair</a>
    </div>
  </div>
</nav>

<!-- Conteúdo -->
<section class="container mt-5">
  <h2 class="mb-4">Painel de Controle</h2>

  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Hospitais Cadastrados</h5>
          <p class="display-6">{{ $hospitais }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Leads Recebidos</h5>
          <p class="display-6">{{ $leads }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Usuários do Sistema</h5>
          <p class="display-6">{{ $usuarios }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-5">
    <a href="/admin/leads" class="btn btn-primary">Gerenciar Leads</a>
    <a href="#" class="btn btn-outline-primary ms-2">Gerenciar Hospitais (em breve)</a>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
