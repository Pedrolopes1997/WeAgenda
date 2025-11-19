<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Paciente - WeAgenda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow-sm">
        <div class="card-body">
          <h2 class="text-center mb-4">Cadastro do Paciente</h2>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form method="POST" action="/paciente/registro">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>CPF</label>
                <input type="text" name="cpf" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control">
              </div>
              <div class="col-md-6 mb-3">
                <label>Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control">
              </div>
              <div class="col-md-6 mb-3">
                <label>Sexo</label>
                <select name="sexo" class="form-select">
                  <option value="">Selecione</option>
                  <option value="M">Masculino</option>
                  <option value="F">Feminino</option>
                  <option value="O">Outro</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Confirmar Senha</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
          </form>
          <div class="mt-3 text-center">
            <a href="/paciente/login">Já tem cadastro? Entrar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
