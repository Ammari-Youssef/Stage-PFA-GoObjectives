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
                        <select class="form-select" id="objective_id" name="ObjectiveID" required>
                            <option value="" disabled selected>{{ __('Select an Objective') }}</option>
                            @foreach ($objectives as $objective)
                                <option value="{{ $objective->id }}">{{ $objective->ObjectiveTitle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="task_title" class="form-label">{{ __('Task Title') }}</label>
                        <input type="text" class="form-control" id="task_title" name="TaskTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="task_description" class="form-label">{{ __('Task Description') }}</label>
                        <textarea class="form-control" id="task_description" name="TaskDescription" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="task_date" class="form-label">{{ __('Task Date') }}</label>
                        <input type="date" class="form-control" id="task_date" name="TaskDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create Task') }}</button>
                </form>
            </div>
        </div>
    </div>

    <x-footer />

</x-master>
