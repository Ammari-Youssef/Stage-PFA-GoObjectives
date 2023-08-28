<x-master title="{{ __('My Objectives') }}">
    <x-navbar />

    <div class="container">
        <h1>Objective List</h1>

        <div class="mb-3">
            <a href="{{ route('objective.create') }}" class="btn btn-primary">{{ __('Create New Objective') }}</a>
        </div>

        @if ($objectives->isEmpty())
        <div class="alert alert-info" role="alert">
            {{ __('You currently have no objectives.') }}
        </div>
        @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Start Date</th>
                        <th>Deadline</th>
                        <th>Importance</th>
                        <th>Done</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($objectives as $objective)
                        <tr>
                            <!-- Rest of your existing code for displaying objective details -->
                            <td>{{ $objective->ObjectiveTitle }}</td>
                            <td>{{ $objective->Category }}</td>
                            <td>{{ $objective->DateStart }}</td>
                            <td>{{ $objective->DateDeadline }}</td>
                            <td>@php
                                $importanceLevels = [
                                    1 => __('Low'),
                                    2 => __('Moderate'),
                                    3 => __('Normal'),
                                    4 => __('High'),
                                    5 => __('Very High'),
                                ];
                            @endphp
                                {{ $importanceLevels[$objective->Importance] }}</td>
                            <td>{{ $objective->isDone ? __('Yes') : __('No') }}</td>
                            <td>
                                <a href="{{ route('objective.show', ['objective' => $objective->id]) }}"
                                    class="btn btn-info btn-sm">{{ __('View') }}</a>
                                <a href="{{ route('objective.edit', ['objective' => $objective->id]) }}"
                                    class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                <form method="POST"
                                    action="{{ route('objective.destroy', ['objective' => $objective->id]) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
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
