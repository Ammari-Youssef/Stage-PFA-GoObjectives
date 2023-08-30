<x-master title="{{ __('Task List') }}">
    <x-navbar />

    <div class="container">
        <h1>Task List</h1>

        <div class="mb-3">
            <a href="{{ route('task.create') }}" class="btn btn-primary">{{ __('Create New Task') }}</a>
        </div>

        @if ($tasks->isEmpty())
            <div class="alert alert-info" role="alert">
                {{ __('No tasks found.') }}
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Task Title</th>
                            <th>Objective</th>
                            <th>Date</th>
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->TaskTitle }}</td>
                                <td>{{ $task->objective->ObjectiveTitle }}</td>
                                <td>{{ $task->TaskDate }}</td>
                                <td>
                                    @if (!$task)
                                        <span class="badge bg-success">{{ __('Done') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Not Done') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('task.show', ['task' => $task->id]) }}"
                                        class="btn btn-info btn-sm">{{ __('View') }}</a>
                                    <a href="{{ route('task.edit', ['task' => $task->id]) }}"
                                        class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                    <form method="POST" action="{{ route('task.destroy', ['task' => $task->id]) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                    </form>
                                    <a href=""
                                        class="btn btn-secondary btn-sm">{{ $task->is_done ? __('Mark as Not Done') : __('Mark as Done') }}</a>
                                </td>
                               <td>
                <form method="POST" action="{{ route('task.toggle-status', ['task' => $task->id]) }}">
                    @csrf
                    <button type="submit"
                            class="btn btn-secondary btn-sm"
                            {{ $task->is_done ? 'disabled' : '' }}>
                        {{ __('Mark as Done') }}
                    </button>
                </form>
            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <x-footer />
</x-master>
