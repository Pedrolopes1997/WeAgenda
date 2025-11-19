<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>WeAgenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 220px;
            background-color: #0050c8;
            color: #fff;
            flex-shrink: 0;
            padding: 20px 0;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #003e9d;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f8f9fa;
        }
        .logout-btn {
            position: absolute;
            bottom: 20px;
            width: 180px;
        }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column justify-content-between position-relative">
        <div>
            <h4 class="text-center mb-4">WeAgenda</h4>

            <!-- Link do Dashboard corrigido -->
            @if(auth()->user()->tipo_usuario === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-primary' : '' }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            @else
                <a href="{{ route('hospital.dashboard') }}" class="{{ request()->routeIs('hospital.dashboard') ? 'bg-primary' : '' }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            @endif

            <a href="{{ route('appointments.index') }}" class="{{ request()->routeIs('appointments.*') ? 'bg-primary' : '' }}">
                <i class="bi bi-calendar-check"></i> Agendamentos
            </a>

            <a href="{{ route('doctors.index') }}" class="{{ request()->routeIs('doctors.*') ? 'bg-primary' : '' }}">
                <i class="bi bi-person-badge"></i> Médicos
            </a>

            <a href="{{ route('specialties.index') }}" class="{{ request()->routeIs('specialties.*') ? 'bg-primary' : '' }}">
                <i class="bi bi-journal-medical"></i> Especialidades
            </a>

            <a href="{{ route('schedules.index') }}" class="{{ request()->routeIs('schedules.*') ? 'bg-primary' : '' }}">
                <i class="bi bi-clock"></i> Horários
            </a>
        </div>

        <div class="text-center mb-3">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger w-75">Sair</button>
            </form>
        </div>
    </div>

    <div class="content">
        @yield('content')
        
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
        
    </div>

<script>
    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    const toastList = toastElList.map(function (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
        toast.show();
    });
</script>
</body>
</html>
