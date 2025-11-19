<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Solicitação</title>
</head>
<body>
    <h2>Nova Solicitação de Demonstração</h2>
    <p><strong>Nome:</strong> {{ $demoRequest->nome }}</p>
    <p><strong>Email:</strong> {{ $demoRequest->email }}</p>
    <p><strong>Telefone:</strong> {{ $demoRequest->telefone }}</p>
    <p><strong>Hospital ou Clínica:</strong> {{ $demoRequest->hospital }}</p>
</body>
</html>
