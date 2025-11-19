<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consultar Agendamento - WeAgenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Consultar Agendamento</h2>
        <form method="POST" action="{{ route('consulta.buscar') }}" class="mx-auto" style="max-width: 400px;">
            @csrf
            <div class="mb-3">
                <label>CPF do Paciente</label>
                <input type="text" name="cpf_paciente" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>
    </div>
</body>
</html>
