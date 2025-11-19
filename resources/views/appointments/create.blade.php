<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamento - WeAgenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Agendamento de Consulta</h2>
        <form method="POST" action="{{ route('appointment.store') }}">
            @csrf

            <div class="mb-3">
                <label>Especialidade</label>
                <select name="specialty_id" id="specialty" class="form-control" required>
                    <option value="">Selecione</option>
                    @foreach ($especialidades as $esp)
                        <option value="{{ $esp->id }}">{{ $esp->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Médico</label>
                <select name="doctor_id" id="doctor" class="form-control" required>
                    <option value="">Selecione a especialidade primeiro</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Nome do Paciente</label>
                <input type="text" name="nome_paciente" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>CPF</label>
                <input type="text" name="cpf_paciente" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email_paciente" class="form-control">
            </div>

            <div class="mb-3">
                <label>Telefone</label>
                <input type="text" name="telefone_paciente" class="form-control">
            </div>

            <div class="mb-3">
                <label>Data</label>
                <input type="date" id="data" name="data" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Hora</label>
                <select name="hora" id="horario" class="form-control" required>
                    <option value="">Selecione o médico e a data</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Confirmar Agendamento</button>
        </form>
    </div>

<script>
    $('#specialty').change(function() {
        const specialtyId = $(this).val();
        $.post("{{ route('appointment.getDoctors') }}", {
            _token: '{{ csrf_token() }}',
            specialty_id: specialtyId
        }, function(data) {
            let options = '<option value="">Selecione</option>';
            data.forEach(doctor => {
                options += `<option value="${doctor.id}">${doctor.nome}</option>`;
            });
            $('#doctor').html(options);
        });
    });

    $('#data, #doctor').on('change', function() {
        const doctorId = $('#doctor').val();
        const data = $('#data').val();

        if (doctorId && data) {
            $.post("{{ route('appointment.times') }}", {
                _token: '{{ csrf_token() }}',
                doctor_id: doctorId,
                data: data
            }, function(horarios) {
                let options = '<option value="">Selecione</option>';
                horarios.forEach(hora => {
                    options += `<option value="${hora}">${hora.substr(0,5)}</option>`;
                });
                $('#horario').html(options);
            });
        }
    });
</script>

    <!-- Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        @if (session('success'))
            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    
        @if (session('error'))
            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Importa o Bootstrap Bundle para funcionar Toast -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
