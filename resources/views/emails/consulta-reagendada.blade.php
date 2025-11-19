<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Consulta Reagendada</title>
</head>
<body>
  <h2>Consulta Reagendada com Sucesso!</h2>
  <p>Olá {{ $agendamento->nome_paciente }},</p>
  <p>Sua consulta foi reagendada para:</p>
  <ul>
    <li><strong>Data:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</li>
    <li><strong>Hora:</strong> {{ $agendamento->hora }}</li>
    <li><strong>Médico:</strong> {{ \App\Models\Doctor::find($agendamento->doctor_id)?->nome ?? 'Não encontrado' }}</li>
  </ul>
  <p>Qualquer dúvida, entre em contato conosco.</p>
  <p>Atenciosamente,<br>Equipe WeAgenda</p>
</body>
</html>
