<x-master title="{{ __('Dashboard') }}">
    <x-navbar />


    <div class="container mt-4">
        <h2>{{ __('Welcome to Your Dashboard') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Goal Progress') }}</h5>
                        <p class="card-text">{{ __('Keep track of your goals and see your progress.') }}</p>
                        <p class="card-text">{{ __('Money: 60% Progress') }}</p>
                        <p class="card-text">{{ __('Health: 40% Progress') }}</p>
                        <!-- ... Repeat for other domains -->
                        <a href="#" class="btn btn-primary">{{ __('View Goals') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Tasks') }}</h5>
                        <p class="card-text">{{ __('Manage your tasks and stay organized.') }}</p>
                        <a href="#" class="btn btn-primary">{{ __('View Tasks') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Progress Charts</h5>
                <canvas id="progressCharts"></canvas>

                <x-charts.progress-chart
    chart-id="userProgress"
    chart-type="pie"
    :labels="['Label A', 'Label B', 'Label C']"
    :progressData="[30, 50, 20]"
    :chartColors="['#FF5733', '#33FF33', '#3366FF']"
/>

            </div>
        </div>
    </div>



    <x-footer />
</x-master>
