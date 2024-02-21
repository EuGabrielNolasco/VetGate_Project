<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estatísticas Gerais') }}
        </h2>
    </x-slot>

    <div class="container mt-5">

    <div class="text-center my-5">
        <h1>Grafico Pizza</h1>
        <hr />
        
    </div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Olá, Tudo bem?</strong> Este gráfico apresenta informações relevantes sobre estatísticas gerais, fornecendo insights valiosos relacionados a animais vacinados, animais não vacinados, total de animais, total de vacinas, usuários com animais e usuários sem animais.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


        <div class="mx-auto" style="width: 82%;">
            <canvas id="graficoPizza" height="300"></canvas>
        </div>
        <br>
            <div class="text-center my-5">

            <div class="my-5 text-center">
  <h2>Gráfico Linha</h2>
  <hr />
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Olá, Tudo bem?</strong> Este gráfico representa qual mês de todos os anos tem mais cadastros de contas, animais e vacinas.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <select id="yearSelector">
    </select>
  <div class="mx-auto" style="width: 100%;">
    <canvas id="graficoLinha" height="300"></canvas>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Assuming Chart.js is being used...
var ctxBar = document.getElementById('graficoLinha').getContext('2d');
var barChart = new Chart(ctxBar, {
  // ... (original chart configuration)
});

// Create options dynamically:
var yearOptions = "";
for (var year = {{ $currentDate->year }} - 10; year <= {{ $currentDate->year }}; year++) {
  yearOptions += "<option value='" + year + "'>" + year + "</option>";
}
$("#yearSelector").html(yearOptions);

$("#yearSelector").change(function() {
  var selectedYear = $(this).val();

  // Filter labels and data based on selectedYear
  // (update the labels and data arrays accordingly)

  // Update the chart using chart.update() or equivalent 
  barChart.update();
  
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    var ctxPizza = document.getElementById('graficoPizza').getContext('2d');
    var myChart = new Chart(ctxPizza, {
        type: 'doughnut',
        data: {
            labels: ['Animais Vacinados', 'Animais Não Vacinados', 'Total De Animais', 'Total De Vacinas', 'Usuario Com Animais','Usuario Sem Animais'],

            datasets: [{
                data: [{{ $animaisComVacinas }}, {{ $animaisSemVacinas }}, {{ $totalAnimais }}, {{ $totalVacinas }}, {{ $usuariosComAnimais }}, {{ $usuariosSemAnimais }}],
                backgroundColor: ['#4CAF50', '#FF5252', '#2196F3', '#E91E63', '#FFC107', '#607D8B'],
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
                backgroundColor: '#4CAF50',
                borderColor: '#4CAF50',
                borderWidth: 1,
            }, {
                label: 'Criações de Animais',
                data: {!! json_encode($animalMonthlyCounts->pluck('count')->toArray()) !!},
                backgroundColor: '#E91E63',
                borderColor: '#E91E63',
                borderWidth: 1,
            }, {
                label: 'Vacinações',
                data: {!! json_encode($vaccinationMonthlyCounts->pluck('count')->toArray()) !!},
                backgroundColor: '#FFC107',
                borderColor: '#FFC107',
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

