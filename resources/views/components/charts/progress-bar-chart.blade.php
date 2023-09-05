   @props(['labels', 'values'])
   <div><canvas id="progressBarChart"></canvas></div>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart
        var ctx = document.getElementById('progressBarChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Average Rating',
                    data: @json($values),
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderWidth: 0
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        max: 10 // Assuming 0-10 is the rating scale
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
