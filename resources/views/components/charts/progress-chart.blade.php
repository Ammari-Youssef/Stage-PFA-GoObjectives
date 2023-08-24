@props(['progressData', 'chartId', 'chartType', 'labels', 'chartColors'])

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
                data: @json($progressData),
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
                    max: 100
                }
            }
        }
    });
</script>