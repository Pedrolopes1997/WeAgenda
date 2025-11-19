<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Gerenciar Leads</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
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
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gerenciar Leads</h2>
    <a href="/admin/leads/export" class="btn btn-success">Exportar Leads</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th>Hospital/Clínica</th>
          <th>Data da Solicitação</th>
        </tr>
      </thead>
      <tbody>
        @forelse($leads as $lead)
          <tr>
            <td>{{ $lead->nome }}</td>
            <td>{{ $lead->email }}</td>
            <td>{{ $lead->telefone }}</td>
            <td>{{ $lead->hospital }}</td>
            <td>{{ $lead->created_at->format('d/m/Y H:i') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Nenhuma solicitação encontrada.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Paginação -->
  <div class="mt-4">
    {{ $leads->links() }}
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
