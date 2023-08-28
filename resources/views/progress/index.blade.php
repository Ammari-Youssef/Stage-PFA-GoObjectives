<x-master title="{{ __('Progress Chart') }}">
    <x-navbar />

    <div class="container mt-4">
        <h2>{{ __('Progress Chart') }}</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Progress Chart</h5>

                        @if ($progressRecords->isEmpty())
                            <p>{{ __('No progress record found.') }}</p>
                        @else
                            <canvas id="progressChart"></canvas>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-master>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('progressChart').getContext('2d');
    var progressData = {
        labels: {!! json_encode($categories) !!},
        datasets: [{
            label: 'Progress',
            data: {!! json_encode($progressDataArray) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderWidth: 0
        }]
    };

    var options = {
        scales: {
            y: {
                beginAtZero: true,
                max: 10
            }
        }
    };

    var chart = new Chart(ctx, {
        type: 'bar',
        data: progressData,
        options: options
    });
</script>
