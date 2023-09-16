<x-master title="{{ __('Create Motive ') }}">
    <x-navbar />
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="alert alert-info">
            <h4>{{__('Motivation Factors')}}</h4>
            <p>{{__('You can have various motives to motivate yourself, such as :')}}</p>
            <ul>
                <li><strong>{{__('Rewards:')}}</strong> {{__('The promise of a reward, such as recognition, a bonus, or a treat, can be a powerful motivator.')}}</li>
                <li><strong>Reasons:</strong> {{__('Having a strong reason or purpose, such as achieving a personal goal, can provide motivation.')}}</li>
                <li><strong>{{__('Penalties:')}}</strong> {{__('Fear of negative consequences or penalties for not taking action can also drive motivation.')}}</li>
            </ul>
        </div>
        <h2>{{ __('Create New Motive') }}</h2>
        <form action="{{ route('motive.store') }}" method="POST">
            @csrf

            <input type="hidden" name="objective_id" value="{{ $objectiveId }}">

            <div class="mb-3">
                <label for="motive_type" class="form-label">{{ __('Motive Type') }}</label>
                <select class="form-select @error('type') is-invalid @enderror" id="motive_type" name="type"
                    required>
                    <option value="" disabled selected>{{ __('Select a Motive Type') }}</option>
                    <option value="reason" {{ old('type') === 'reason' ? 'selected' : '' }}>
                        {{ __('Reason : Why doing this objective ?') }}</option>
                    <option value="reward" {{ old('type') === 'reward' ? 'selected' : '' }}>
                        {{ __('Reward : Reward yourself after doing your goal') }}</option>
                    <option value="penalty" {{ old('type') === 'penalty' ? 'selected' : '' }}>
                        {{ __('Penalty : Punish yourself if you do not do your goal') }}</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Motive Title') }}</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ 'Motive Description' }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Create Motive') }}</button>
        </form>
    </div>
    <x-footer />
</x-master>
