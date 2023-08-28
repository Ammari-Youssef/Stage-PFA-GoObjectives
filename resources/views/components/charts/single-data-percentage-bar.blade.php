@props(['label', 'value', 'max'])



<script>
    // Sample data
    var data = {
        labels: ["Progress"],
        datasets: [{
            data: [75], // Replace with your actual data
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderWidth: 0
        }]
    };

    var options = {
        scales: {
            x: {
                beginAtZero: true,
                max: 100
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    };

    var ctx = document.getElementById('curvedBarChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'horizontalBar',
        data: data,
        options: options
    });
</script>

<div class="percentage-bar">
    <div class="d-flex justify-content-between align-items-center">
        <span>{{ $label }}</span>
        <span>{{ $value }} / {{ $max }}</span>
    </div>
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{ ($value / $max) * 100 }}%;" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="{{ $max }}"></div>
    </div>
</div>