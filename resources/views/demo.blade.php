<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solicitar Demonstração - WeAgenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Helvetica Neue', sans-serif; background-color: #f8f9fa; }
    .form-container { max-width: 600px; margin: 80px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

<!-- Header Simples -->
<nav class="navbar navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">
      <img src="/img/logo-weagenda.png" alt="WeAgenda" height="50">
    </a>
  </div>
</nav>

<!-- Formulário -->
<section>
  <div class="container">
    <div class="form-container">
      <h2 class="text-center mb-4">Solicitar Demonstração</h2>

      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="/demo/submit">
        @csrf

        <div class="mb-3">
          <label for="nome" class="form-label">Nome Completo</label>
          <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>

        <div class="mb-3">
          <label for="hospital" class="form-label">Hospital ou Clínica</label>
          <input type="text" class="form-control" id="hospital" name="hospital" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Solicitar Agora</button>
      </form>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer mt-5">
  <div class="container text-center">
    <p class="small">&copy; 2025 WeAgenda. Desenvolvido por WCIC.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
