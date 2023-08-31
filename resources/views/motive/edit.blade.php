<x-master title="{{ __('Edit Motive') }}">
    <x-navbar />

    <div class="container mt-4">
        <h2>{{ __('Edit Motive') }}</h2>
        <form action="{{ route('motive.update', $motive->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="MotiveType" class="form-label">{{ __('Motive Type') }}</label>
                <select class="form-select @error('MotiveType') is-invalid @enderror" id="MotiveType" name="MotiveType" required>
                    <option value="reason" {{ old('MotiveType', $motive->MotiveType) === 'reason' ? 'selected' : '' }}>Reason</option>
                    <option value="reward" {{ old('MotiveType', $motive->MotiveType) === 'reward' ? 'selected' : '' }}>Reward</option>
                    <option value="penalty" {{ old('MotiveType', $motive->MotiveType) === 'penalty' ? 'selected' : '' }}>Penalty</option>
                </select>
                @error('MotiveType')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="MotiveTitle" class="form-label">{{ __('Motive Title') }}</label>
                <input type="text" class="form-control @error('MotiveTitle') is-invalid @enderror" id="MotiveTitle" name="MotiveTitle" value="{{ old('MotiveTitle', $motive->MotiveTitle) }}" required>
                @error('MotiveTitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="MotiveDescription" class="form-label">{{ __('Motive Description') }}</label>
                <textarea class="form-control @error('MotiveDescription') is-invalid @enderror" id="MotiveDescription" name="MotiveDescription" rows="4" required>{{ old('MotiveDescription', $motive->MotiveDescription) }}</textarea>
                @error('MotiveDescription')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Update Motive') }}</button>
        </form>
    </div>

    <x-footer />
</x-master>
