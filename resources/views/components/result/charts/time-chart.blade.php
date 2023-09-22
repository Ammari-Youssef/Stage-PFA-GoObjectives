@props(['labels', 'data', 'average', 'target_time'])

<div>
    <canvas id="time-chart"></canvas>
</div>

<script>
    var ctx = document.getElementById('time-chart').getContext('2d');
    var targetTime = {{ strtotime($target_time) }};



    console.log('json data', @json($data))

    var chartData = {
        labels: @json($labels), // X-axis labels (dates)
        datasets: [{
                label: 'Experienced Time Results',
                data: @json($data), // Formatted time data in HH:mm:ss format
                borderColor: 'rgba(0, 0, 255, 1)',
                backgroundColor: 'rgba(0, 0, 255, 0.2)',
                borderWidth: 2,
                fill: true
            },
            {
                label: 'Average',
                data: @json($average), // Average time data in seconds
                borderColor: 'rgba(255, 0, 0, 1)',
                backgroundColor: 'rgba(255, 0, 0, 0.2)',
                borderWidth: 2,
                fill: true
            },
            {
                label: 'Target Time',
                data: Array(@json($labels).length).fill(targetTime), // Array of the same target time value
                borderColor: 'rgba(0, 255, 0, 1)', // Green color for the target line
                borderWidth: 2,
                fill: false // Do not fill the area under the target line
            }
        ]
    };

    var chartConfig = {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        text: 'Dates',
                        display: true
                    }
                },
                y: {
                    // beginAtZero: true,
                    // max: {{ strtotime($target_time) + 10 }}, // Adjust the maximum y-axis value as needed

                    title: {
                        text: 'Time (HH:mm:ss)',
                        display: true
                    },
                    ticks: {
                        // Format the y-axis ticks as HH:mm:ss
                        callback: function(value) {
                            var date = new Date(value * 1000);
                            return date.toISOString().substr(11, 8);
                        }
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Result Chart for Time Objective', // Title for your chart
                    font: {
                        size: 16
                    }
                }
            }
        }
    };

    var myChart = new Chart(ctx, chartConfig);
</script>
