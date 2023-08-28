@props(['progressData', 'chartId', 'chartType', 'labels', 'chartColors'])

@php
    // Calculate complementary values
    $complementaryData = array_map(function ($value) {
        return 10 - $value;
    }, $progressData);
@endphp

<div>
    <canvas id="{{ $chartId }}"></canvas>
</div>

<script>
    const ctx{{ $chartId }} = document.getElementById('{{ $chartId }}').getContext('2d');
    new Chart(ctx{{ $chartId }}, {
        type: '{{ $chartType }}',
        data: {
            labels: @json($labels),
            datasets: [{
                data: @json($complementaryData),
                backgroundColor: @json($chartColors)
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10
                }
            }
        }
    });
</script>
