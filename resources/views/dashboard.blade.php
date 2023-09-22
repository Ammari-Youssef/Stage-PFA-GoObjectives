<x-master title="{{ __('Dashboard') }}">
    <x-navbar />


    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <h2>{{ __('Welcome to Your Dashboard') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Current Objectives') }}</h5>
                        <p class="card-text">{{ __('Keep track of your goals and see your progress.') }}</p>
                        @foreach ($objectives as $index => $objectif)
                            
                                <p class="card-text"> - {{ $objectif->Category->name }} :
                                    {{ $objectif->title }} <a href="{{route("objective.show",$objectif->id)}}">{{__("Add result")}}</a></p>
                        
                        @endforeach
                        {{-- <p class="card-text">{{ __('Health: 40% Progress') }}</p> --}}
                        <!-- ... Repeat for other domains -->
                        <a href="{{ route('objective.index') }}" class="btn btn-primary">{{ __('View Objectives') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Tasks') }}</h5>
                        <p class="card-text">{{ __('Manage your tasks and stay organized.') }}</p>
                        @if (count($tasks) > 0)
                            <ul>
                                @foreach ($tasks as $task)
                                    <li>{{ $task->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="alert alert-info" role=alert>{{ __('No tasks for today.') }}</p>
                        @endif
                        <a href="{{ route('task.index') }}" class="btn btn-primary">{{ __('View Tasks') }}</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-3 mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Intrest Chart') }}</h5>

                        @if ($progressDataArray)
                            <x-charts.progress-chart chart-id="progressCharts" chart-type="pie" :labels="$labels"
                                :progressData="$progressDataArray" :chartColors="$colors" />
                        @else
                            <p class="alert alert-info" role="alert">
                                {{ __('You currently have no progress data to show the interest chart.') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Recomanded chart') }}</h5>

                        @if ($progressDataArray)
                            <x-charts.recomanded-progress-chart chart-id="recprogressCharts" chart-type="pie"
                                :labels="$labels" :progressData="$progressDataArray" :chartColors="$colors" />
                        @else
                            <p class="alert alert-info" role="alert">
                                {{ __('You currently have no progress data to show the recomanded chart.') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Progress Bar</h5>
                        @if ($progressDataArray)
                            @foreach ($progressData as $progress)
                                <div class="progress-bar-container">
                                    <x-charts.single-data-percentage-bar label="{!! $progress->category->name !!}"
                                        value="{{ $progress->rating }}" max="10" id="{{ $progress->id }}" />

                                </div>
                            @endforeach
                            <a href=" {{ route('progress.edit', $userId) }}"
                                class="btn btn-primary mt-3">{{ __('ُEdit Progress') }}</a>
                        @else
                            <p class="alert alert-info" role="alert">{{ __('You currently have no progress data.') }}
                            </p>
                            <a href="{{ route('progress.create') }}"
                                class="btn btn-primary">{{ __('Add Progress') }}</a>
                        @endif



                    </div>
                </div>
            </div>



        </div>



        <x-footer />
</x-master>
