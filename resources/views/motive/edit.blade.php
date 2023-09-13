<x-master title="{{ __('Edit Motive') }}">
    <x-navbar />

    <div class="container mt-4">
        <h2>{{ __('Edit Motive') }}</h2>
        <form action="{{ route('motive.update', $motive->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">{{ __('Motive Type') }}</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="reason" {{ old('type', $motive->type) === 'reason' ? 'selected' : '' }}>Reason</option>
                    <option value="reward" {{ old('type', $motive->type) === 'reward' ? 'selected' : '' }}>Reward</option>
                    <option value="penalty" {{ old('type', $motive->type) === 'penalty' ? 'selected' : '' }}>Penalty</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Motive Title') }}</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $motive->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Motive Description') }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $motive->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Update Motive') }}</button>
        </form>
    </div>

    <x-footer />
</x-master>
