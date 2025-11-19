@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Dashboard WeAgenda</h3>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Total de Agendamentos</h5>
                    <h2>{{ $total }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Confirmados</h5>
                    <h2 class="text-success">{{ $confirmados }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Cancelados</h5>
                    <h2 class="text-danger">{{ $cancelados }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5>Pendentes</h5>
                    <h2 class="text-warning">{{ $pendentes }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h5>Bem-vindo, {{ Auth::user()->name }}</h5>
        <p class="text-muted">Gerencie seus agendamentos e veja informações rápidas aqui no painel.</p>
    </div>
</div>

<div class="mt-5 d-flex justify-content-center">
    <div style="max-width: 400px; height: 400px;">
        <h4 class="text-center">Resumo de Agendamentos</h4>
        <canvas id="graficoAgendamentos" width="400" height="400"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('graficoAgendamentos').getContext('2d');
const graficoAgendamentos = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Confirmados', 'Cancelados', 'Pendentes'],
        datasets: [{
            data: [{{ $confirmados }}, {{ $cancelados }}, {{ $pendentes }}],
            backgroundColor: [
                'rgb(25, 135, 84)',
                'rgb(220, 53, 69)',
                'rgb(255, 193, 7)'
            ],
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
<div class="mt-5">
    <h4 class="text-center">Evolução de Agendamentos (Últimos 30 dias)</h4>
    <canvas id="graficoEvolucao" height="100"></canvas>
</div>

<script>
    const ctx2 = document.getElementById('graficoEvolucao').getContext('2d');
    const graficoEvolucao = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: {!! json_encode($dias) !!},
            datasets: [{
                label: 'Agendamentos por dia',
                data: {!! json_encode($totais) !!},
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.3,
                pointBackgroundColor: 'rgb(75, 192, 192)',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@endsection
