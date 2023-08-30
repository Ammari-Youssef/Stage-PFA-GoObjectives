<x-master title="{{ __('Edit Progress') }}">
    <x-navbar />
    
    <div class="container mt-4">
        <h2>{{ __('Edit Progress') }}</h2>
        <form action="{{ route('progress.update') }}" method="POST">
            @csrf
            @foreach ($categories as $index => $category)
                <div class="mb-3">
                    <label for="{{ $category->name }}">{{ $category->name }}</label>
                    <input type="number" class="form-control" name="progress[{{ $category->id }}]"
                           value="{{ $progressData[$index]->value }}" step="0.1" min="0" max="10" required>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">{{ __('Update Progress') }}</button>
        </form>
    </div>
    
    <x-footer />
</x-master>
