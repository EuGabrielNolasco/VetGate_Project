<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estatísticas Gerais') }}
        </h2>
    </x-slot>


    <div class="text-center my-5">
        <h1>Grafico Pizza</h1>
        <hr />
    </div>
    <div class="container mt-5">
        <div class="mx-auto" style="width: 70%;">
            <canvas id="graficoPizza" height="300"></canvas>
        </div>
        <div class="text-center my-5">
        <h1>Grafico  Linha</h1>
        <hr />
    </div>        <div class="mx-auto" style="width: 100%;">
            <canvas id="graficoLinha" height="300"></canvas>
        </div><br>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-TX8qUY4rW9NcRMvz9GomMAOoOSZrsbHiGhXPp9uWHb8khoUzgPBM9DB7lNbr7GRj" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctxPizza = document.getElementById('graficoPizza').getContext('2d');
        var myChart = new Chart(ctxPizza, {
            type: 'doughnut',
            data: {
                labels: ['Animais Vacinados', 'Animais Não Vacinados', 'Total de Animais', 'Total Vacinas'],
                datasets: [{
                    data: [{{ $animaisComVacinas }}, {{ $animaisSemVacinas }}, {{ $totalAnimais }}, {{ $totalVacinas }}],
                    backgroundColor: ['#33ff33', 'red', 'blue', '#ff0084'],
                }],
            },
            options: {
                responsive: true,
                cutout: '40%', // ajuste conforme necessário
                radius: '95%', // ajuste conforme necessário
                rotation: 0,
                circumference: 360,
                animation: {
                    animateRotate: true,
                    animateScale: true,
                },
            },
        });
    </script>

<script>
    var ctxBar = document.getElementById('graficoLinha').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'Contas de Usuário',
                data: {!! json_encode($userMonthlyCounts->pluck('count')->toArray()) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }, {
                label: 'Criações de Animais',
                data: {!! json_encode($animalMonthlyCounts->pluck('count')->toArray()) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
            }, {
                label: 'Vacinações',
                data: {!! json_encode($vaccinationMonthlyCounts->pluck('count')->toArray()) !!},
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1,
            }],
            labels: {!! json_encode($userMonthlyCounts->pluck('month')->toArray()) !!}
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        },
    });
</script>





</x-app-layout>

