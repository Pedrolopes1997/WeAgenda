<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Agendamentos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; margin: 20px; }
        header { text-align: center; margin-bottom: 20px; }
        header h1 { margin: 0; font-size: 24px; }
        header p { margin: 0; font-size: 12px; color: #666; }
        footer { text-align: center; font-size: 10px; position: fixed; bottom: 10px; left: 0; right: 0; color: #888; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>
<body>

    <header>
        <h1>WeAgenda</h1>
        <p>Relatório de Agendamentos</p>
        <p>Emitido em: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </header>

    <table>
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidade</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendamentos as $agendamento)
                <tr>
                    <td>{{ $agendamento->nome_paciente }}</td>
                    <td>{{ $agendamento->doctor->nome }}</td>
                    <td>{{ $agendamento->doctor->specialty->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                    <td>{{ substr($agendamento->hora, 0, 5) }}</td>
                    <td>{{ ucfirst($agendamento->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Relatório gerado pelo sistema WeAgenda
    </footer>

</body>
</html>
