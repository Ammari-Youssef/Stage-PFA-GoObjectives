@props(['type' => 'bar', 'data' => [], 'labels' => []])

<div>
    <canvas id="chart" ></canvas>
</div>

<script>
    var ctx = document.getElementById('chart').getContext('2d');

    var chartData = {
        labels: @json($labels),
        datasets: [{
            label: 'Results',
            data: @json($data),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    var chartConfig = {
        type: @json($type),
        data: chartData,
        options: {
            // Configure chart options here
        }
    };

    var myChart = new Chart(ctx, chartConfig);
</script>
