<x-master title="{{ __('Create Task') }}">
    <x-navbar />

    <div class="container">
        <h1>{{ __('Create Task') }}</h1>
  @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('task.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="objective_id" class="form-label">{{ __('Select Objective') }}</label>
                        <select class="form-select" id="objective_id" name="objective_id" required>
                            <option value="" disabled {{ !request('objective-id') ? 'selected' : '' }}>{{ __('Select an Objective') }}</option>
                            @foreach ($objectives as $objective)
                                <option value="{{ $objective->id }}" {{ request('objective-id') == $objective->id ? 'selected' : '' }} >{{ $objective->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="task_title" class="form-label">{{ __('Task Title') }}</label>
                        <input type="text" class="form-control" id="task_title" name="title" value="{{old('title')}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="task_description" class="form-label">{{ __('Task Description') }}</label>
                        <textarea class="form-control" id="task_description" name="description" rows="4" value="{{old('description')}}" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="task_date" class="form-label">{{ __('Task Date') }}</label>
                        <input type="date" class="form-control" id="task_date" name="date" value="{{old('date')}}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create Task') }}</button>
                </form>
            </div>
        </div>
    </div>

    <x-footer />
</x-master>
