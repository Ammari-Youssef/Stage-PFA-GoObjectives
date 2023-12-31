{{-- Page out of service  --}}
<x-master title="{{ __('Task Details') }}">

    <x-navbar />

    <div class="container">
        <h1>Task Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text">{{ $task->description }}</p>
                <p class="card-text"><strong>Objective:</strong> {{ $task->objective->title }}</p>
                <p class="card-text"><strong>Date:</strong> {{ $task->date }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $task->created_at }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $task->updated_at }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('task.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>
    </div>

    <x-footer />

</x-master>
