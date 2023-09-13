<x-master title="{{ __('Objective details') }}">
    <x-navbar />
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <h1>{{ __('Objective Details') }}</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $objective->title }}</h5>
                <p class="card-text"><strong>{{ __('Description') }}:</strong>
                    @if ($objective->description)
                        {{ Str::ucfirst($objective->description) }}
                    @else
                        {{ __('No description available') }}
                    @endif
                </p>
                <p class="card-text"><strong>{{ __('Category') }}:</strong> {{ $objective->category->name }}</p>
                <p class="card-text"><strong>{{ __('Type') }}:</strong> {{ Str::ucfirst($objective->type) }}</p>

                <p class="card-text"><strong>{{ __('Current Goal') }}:</strong>
                    @if ($objective->type === 'number')
                        {{ $objective->number_value }}
                    @elseif ($objective->type === 'time')
                        {{ $formattedTime }}
                    @elseif ($objective->type === 'behavioral')
                        {{ $objective->behavior_option ? __('Do ') . $objective->title : __('Do Not Do ') . $objective->title }}
                    @else
                        {{ __('No current goal available') }}
                    @endif
                </p>
                <hr>

                <h5 class="card-title">{{ __('Additional Details') }}</h5>
                <p class="card-text"><strong>{{ __('Motives') }}: {{ $objective->motive->count() }}</strong> </p>
                @if ($objective->motive->count() > 0)
                    @foreach ($objective->motive as $motive)
                        <!-- Display motive details -->
                        <p data-motive-id="{{ $motive->id }}">
                        <div class="col-6">{{ $motive->title }}</div>

                        <div class="col-6">
                            <!-- Add a "View" button that links to the motive's details page -->
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#motiveDetailsModal" title="View">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Include the motive details modal component -->
                            <x-motive.show-motive-details :motive="$motive" />

                            <!-- Add an "Edit" button that links to the motive's edit page -->
                            <a href="{{ route('motive.edit', ['motive' => $motive->id]) }}"
                                class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Add a "Delete" button that triggers a delete confirmation modal -->
                            <button class="btn btn-sm btn-danger" data-motive-id="{{ $motive->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form method="POST" action="{{ route('motive.destroy', ['motive' => $motive->id]) }}"
                                id="delete-form-{{ $motive->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>

                        </p>
                    @endforeach
                @else
                    <div class="alert alert-info" role="alert">
                        {{ __('No motives available') }}
                    </div>
                @endif
                 <a class="btn btn-primary"
                            href="{{ route('motive.create', ['objective_id' => $objective->id]) }}">{{ __('Add Motive') }}</a>
                </p>


                <p class="card-text"><strong>{{ __('Level') }}:</strong>
                    @if ($objective->level)
                        {{ $objective->level }}
                    @else
                        {{ __('No level available') }}
                    @endif
                </p>

                @if ($objective->type === 'essential')
                    <p class="card-text"><strong>{{ __('Subobjectives') }}:</strong></p>
                    @if ($objective->subobjectives->count() > 0)
                        <ul>
                            @foreach ($objective->subobjectives as $subobjective)
                                <li>
                                    {{ $subobjective->title }}

                                    <a href="{{ route('objective.show', ['objective' => $subobjective->id]) }}"
                                        class="btn ">
                                        <i class="fas fa-eye"></i></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('No subobjectives available') }}
                        </div>
                    @endif
                    <a href="{{ route('objective.create', ['objective_parent_id' => $objective->id]) }}"
                        class="btn btn-primary">
                        {{ __('Add Subobjective') }}
                    </a>
                @endif


                <p class="card-text"><strong>{{ __('Tasks') }}: {{$objective->tasks->count()}} </strong></p>
                @if ($objective->tasks->count() > 0)
                    <ul>
                        @foreach ($objective->tasks as $task)
                            <li>{{ $task->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-info" role="alert">
                        {{ __('No tasks available') }}
                    </div>
                @endif
                <button class="btn btn-primary" id="addTask" >{{ __('Add Task') }}</button>



                <p class="card-text"><strong>{{ __('Result') }}:</strong>
                    @if ($objective->result)
                        {{ $objective->result }}
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('No result available') }}
                        </div>
                        <a href="{{ route('task.create') }}" class="btn btn-primary">{{ __('Add result') }}</a>
                    @endif
                </p>

            </div>
        </div>
    </div>

    <x-footer />
</x-master>

<script>
    // Function to handle AJAX delete
    function deleteMotive(motiveId) {

        $.ajax({
            type: 'DELETE',
            url: '{{ route('motive.destroy', '') }}/' + motiveId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Add CSRF token
            },
            success: function() {
                // On success, remove the motive element from the page
                $(`p[data-motive-id="${motiveId}"]`).remove();
                Swal.fire('Deleted', 'The motive has been deleted successfully.', 'success');
                window.location.reload();
            },
            error: function() {
                Swal.fire('Error', 'An error occurred while deleting the motive.', 'error');
            },
        });
    }

    // Handle delete button clicks
    $('button.btn-danger').on('click', function() {
        const motiveId = $(this).data('motive-id');
        Swal.fire({
            title: 'Confirm Deletion',
            text: 'Are you sure you want to delete this motive ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                deleteMotive(motiveId);
            }
        });
    });
</script>
