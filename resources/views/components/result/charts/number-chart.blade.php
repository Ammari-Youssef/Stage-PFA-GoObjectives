@props(['labels', 'data', 'average', 'target_number'])
<div>
    <canvas id="number-chart"></canvas>

</div>


<script>
    var ctx = document.getElementById('number-chart').getContext('2d');
    
    var labelsLength = @json(count($labels));

    // Get the target number from the prop
    var targetNumber = @json($target_number);

    // Create an array with the target number repeated for the labels length
    var targetData = Array(labelsLength).fill(targetNumber);
    var chartData = {
        labels: @json($labels), //X axe
        datasets: [{
                label: 'Number Result Values', //Tooltip avec clé explicatif
                data: @json($data),
                borderColor: 'rgba(0, 0, 255, 1)', // Blue border color with no transparency
                backgroundColor: 'rgba(0, 0, 255, 0.2)', // Blue background color with transparency
                borderWidth: 2,
                fill: true
            },
            {
                label: 'Average',
                data: @json($average),
                borderColor: 'rgba(255, 0, 0, 1)',
                backgroundColor: 'rgba(255, 0, 0, 0.2)',
                borderWidth: 2,
                fill: true
            },
            {
                label: 'Target',
                data: targetData,
                borderColor: 'rgba(0, 255, 0, 1)',
                backgroundColor: 'rgba(0, 255, 0, 0.2)',
                borderWidth: 2,
                fill: false
            },


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
                    beginAtZero: true,
                    // max: {{ $target_number }} ,
                    title: {
                        text: 'Values',
                        display: true
                    }

                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Result Chart for Number Objective', // Title for your chart
                    font: {
                        size: 16
                    }
                },

            }


        }

    };

    var myChart = new Chart(ctx, chartConfig);
</script>
