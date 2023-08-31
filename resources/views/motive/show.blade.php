<x-master title="{{ __('Motive Details') }}">
    <x-navbar />

    <div class="container mt-4">
        <h2>{{ __('Motive Details') }}</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $motive->MotiveTitle }}</h5>
                <p class="card-text"><strong>{{ __('Motive Type') }}:</strong> {{ ucfirst($motive->MotiveType) }}</p>
                <p class="card-text"><strong>{{ __('Motive Description') }}:</strong> {{ $motive->MotiveDescription }}</p>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('motive.edit', $motive->id) }}" class="btn btn-primary">{{ __('Edit Motive') }}</a>
        </div>
    </div>

    <x-footer />
</x-master>
