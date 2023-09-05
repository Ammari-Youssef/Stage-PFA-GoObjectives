   @props(['labels', 'values'])
   <div><canvas id="progressLineChart"></canvas></div>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Line Chart
        var lineCtx = document.getElementById('progressLineChart').getContext('2d');
        var lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Average Rating Over Time',
                    data: @json($values),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        max: 10
                    }
                }
            }
        });
    });
</script>