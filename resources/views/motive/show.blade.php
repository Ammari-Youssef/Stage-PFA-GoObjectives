<x-master title="{{ __('Motive Details') }}">
    <x-navbar />

    <div class="container mt-4">
        <h2>{{ __('Motive Details') }}</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $motive->title }}</h5>
                <p class="card-text"><strong>{{ __('Motive Type') }}:</strong> {{ ucfirst($motive->type) }}</p>
                <p class="card-text"><strong>{{ __('Motive Description') }}:</strong> {{ $motive->description }}</p>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('motive.edit', $motive->id) }}" class="btn btn-primary">{{ __('Edit Motive') }}</a>
            <a href="{{ route('objective.show', $motive->objective_id) }}" class="btn btn-primary">{{ __('Back to Objective\'s details') }}</a>
        </div>
    </div>

    <x-footer />
</x-master>
