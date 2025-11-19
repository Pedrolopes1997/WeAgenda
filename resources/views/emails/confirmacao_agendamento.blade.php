<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Agendamento</title>
</head>
<body>
    <h2>Confirmação de Agendamento</h2>

    <p>Olá {{ $agendamento->nome_paciente }},</p>

    <p>Seu agendamento foi realizado com sucesso!</p>

    <ul>
        <li><strong>Médico:</strong> {{ $agendamento->doctor->nome }}</li>
        <li><strong>Especialidade:</strong> {{ $agendamento->doctor->specialty->nome }}</li>
        <li><strong>Data:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</li>
        <li><strong>Hora:</strong> {{ substr($agendamento->hora,0,5) }}</li>
    </ul>

    <p>Obrigado por escolher o WeAgenda!</p>
</body>
</html>
