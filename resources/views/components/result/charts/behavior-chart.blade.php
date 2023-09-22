@props(['labels','didItCount','didNotDoItCount','planningdaysCount'])
<div>
    <canvas id="behavior-chart"></canvas>
</div>


<script>
    var ctx = document.getElementById('behavior-chart').getContext('2d');

   var didItCount = {{$didItCount}} ;
    var didNotDoItCount = {{$didNotDoItCount}};
    var planningdaysCount = {{$planningdaysCount}};

    var chartData = {
        labels: ['',],
    
        datasets: [
       {
                label: 'Did Do ',
                data: [didItCount, ],
                backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)'],
                borderWidth: 1,
            },
            {
                label: 'Did Not Do',
                data: [didNotDoItCount],
                backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)'],
                borderWidth: 1,
            },
            {
                label: 'Target',
                data: [planningdaysCount],
                backgroundColor: ['rgba(0, 255, 0, 0.2)'],
                borderColor: ['rgba(0, 255, 0, 1)'],
                borderWidth: 1,
            },
           
          
        ]
    
    };

    var chartConfig = {
        type: 'bar',
        data: chartData,
        options: {
          responsive: true,
            maintainAspectRatio: true,
           scales:{
            x: {
                display: true,
                title: {
                    display: true,
                    text: 'Dates'
                }
            },
                    y: {
                beginAtZero: true,
                display: true,
                title: {
                    display: true,
                    text: 'Count'
                }
           }
        } ,plugins: {
            title: {
                display: true,
                text: 'Behavioral Chart', // Title for your chart
                font: {
                    size: 16
                }
            }
        }
    }
};

    var myChart = new Chart(ctx, chartConfig);
</script>

