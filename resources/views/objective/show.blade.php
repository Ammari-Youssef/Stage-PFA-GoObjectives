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
                <p class="card-text"><strong>{{ __('Start date :') }}</strong> {{ $objective->start_date }}</p>
                <p class="card-text"><strong>{{ __('End date :') }}</strong> {{ $objective->end_date }}</p>
                <!-- Add a button to go to the editing page (objective.edit) -->
                <a href="{{ route('objective.edit', ['objective' => $objective->id]) }}"
                    class="btn btn-primary">{{ __('Edit Objective') }}</a>

                <a href="{{ route('objective.index') }}" class="btn btn-secondary">{{ __('Back to Objectives') }}</a>
                <hr>

                <h5 class="card-title">{{ __('Additional Details') }}</h5>
                <p class="card-text "><strong>{{ __('Motives') }}: {{ $objective->motive->count() }}</strong> </p>
                @if ($objective->motive->count() > 0)
                    @foreach ($objective->motive as $motive)
                        <!-- Display motive details -->
                    <div data-motive-id="{{ $motive->id }}" class="p-2">
                        <div class="col-6">{{ $motive->title }} ({{ Str::ucfirst($motive->type) }})</div>

                        <div class="col-6 p-1">
                            <!-- Add a "View" button that links to the motive's details page -->
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#motiveDetailsModal{{ $motive->id }}" title="View">
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
                            <button class="btn btn-sm btn-danger delete-motive" data-motive-id="{{ $motive->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form method="POST" action="{{ route('motive.destroy', ['motive' => $motive->id]) }}"
                                id="delete-form-{{ $motive->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>

                    </div>
                    @endforeach
                @else
                    <div class="alert alert-info" role="alert">
                        {{ __('No motives available') }}
                    </div>
                @endif
                <a class="btn btn-primary mt-2"
                    href="{{ route('motive.create', ['objective_id' => $objective->id]) }}">{{ __('Add Motive') }}</a>
                </p>


                <p class="card-text"><strong>{{ __('Levels') }}:</strong>
                    @if ($objective->levels)
                        @foreach ($objective->levels as $level)
                            <p class="card-text alert {{ $level->status ? 'alert-success' : 'alert-info' }}"
                                role="alert">
                                <b>{{ $level->title }}</b>: {{ $level->description }}
                                @if ($level->status)
                                    (Achieved)
                                @endif
                                <button data-target="#editLevelModal" data-toggle="modal"
                                    class="btn btn-info btn-sm edit-Level-btn" data-level-id="{{ $level->id }}"><i
                                        class="fas fa-edit"></i></button>
                                <button
                                    class="btn btn-sm toggle-status {{ $level->status ? 'btn-success' : 'btn-secondary' }}"
                                    data-level="{{ $level->id }}">
                                    <i class="fa-regular {{ $level->status ? 'fa-thumbs-up' : 'fa-thumbs-down' }}"></i>
                                </button>
                            </p>
                        @endforeach
                    @else
                        <div class="alert alert-info" role="info">{{ __('No levels available') }}</div>
                    @endif
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addLevelModal">
                        Add Level
                    </button>

                    <x-level.edit-level />
                    <x-level.add-level :objective="$objective" />
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


                <p class="card-text"><strong>{{ __('Tasks') }}: {{ $objective->tasks->count() }} </strong></p>
                @if ($objective->tasks->count() > 0)
                    <ul>
                        @foreach ($objective->tasks as $task)
                            <li>{{ $task->title }}
                                <button data-toggle="modal" data-target="#taskModal" class="btn  view-task-btn"
                                    data-task-id="{{ $task->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                            </li>
                        @endforeach
                        <x-task.show-task-details />
                    </ul>
                @else
                    <div class="alert alert-info" role="alert">
                        {{ __('No tasks available') }}
                    </div>
                @endif
                <a class="btn btn-primary" id="addTask"
                    href="{{ route('task.create', ['objective-id' => $objective->id]) }}">{{ __('Add Task') }}</a>

                    
                <p class="card-text "><strong>{{ __('Result') }}:</strong>

                    @if ($objective->type === 'number' && $results->isNotEmpty())
                        <x-result.charts.number-chart :data="$numberData" :average="$averageNumberData" :labels="$labels"
                            :target_number="$objective->number_value" />
                    @elseif ($objective->type === 'time' && $results->isNotEmpty())
                        <x-result.charts.time-chart :data="$timeData" :labels="$labels" :target_time="$objective->target_time"
                            :average="$averageTimeData" />
                    @elseif ($objective->type === 'behavioral' && $results->isNotEmpty())
                        <x-result.charts.behavior-chart :didItCount='$DidItCount' :didNotDoItCount='$DidNotDoItCount' :planningdaysCount="$planningdaysCount" />
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('No result available') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addResultModal">
                        {{ __(' Add Result') }}
                    </button>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#viewResultsModal">
                        {{ __(' View Results') }}
                    </button>
                </p>

                <x-result.add-result-modal :objective='$objective' />
                <x-result.edit-result-modal />
                <x-result.view-results-modal :results="$results" :objective="$objective" />


            </div>
        </div>
    </div>

    <x-footer />
</x-master>
{{-- Delete Motive --}}
<script>
    // Function to handle AJAX delete
    function deleteMotive(motiveId) {

        $.ajax({
            type: 'DELETE',
            url: '{{ route('motive.destroy', '') }}/' + motiveId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Add CSRF token
            },
            success: function(response) {
                console.log('response motive', response)
                // On success, remove the motive element from the page
                $(`div[data-motive-id="${response.motive_id}"]`).remove();
                Swal.fire('Deleted', 'The motive has been deleted successfully.', 'success');
               
            },
            error: function() {
                Swal.fire('Error', 'An error occurred while deleting the motive.', 'error');
            },
        });
    }

    // Handle delete button clicks
    $('button.delete-motive').on('click', function() {
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

{{-- Toggle Level completion --}}
<script>
    $(document).ready(function() {
        $('.toggle-status').click(function() {
            var levelId = $(this).data('level');
            var token = $('meta[name="csrf-token"]').attr(
                'content'); // Get the CSRF token from the meta tag

            $.ajax({
                type: 'POST',
                url: '/level/' + levelId + '/toggleStatus',
                headers: {
                    'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
                },
                success: function(response) {
                    // Update the status in the table or perform any other desired actions
                    // You can add logic here to visually update the status in the table

                    console.log(response);
                    const $statusButton = $('.toggle-status[data-level="' + levelId + '"]');
                    const alert = $('.alert-info')

                    if (response.status) {
                        $statusButton.removeClass('btn-secondary').addClass('btn-success');
                        $statusButton.find('i').removeClass('fa-thumbs-down').addClass(
                            'fa-thumbs-up');
                        $statusButton.closest('.card-text').toggleClass(
                            'alert-info alert-success');
                    } else {
                        $statusButton.removeClass('btn-success').addClass('btn-secondary');
                        $statusButton.find('i').removeClass('fa-thumbs-up').addClass(
                            'fa-thumbs-down');
                        $statusButton.closest('.card-text').toggleClass(
                            'alert-info alert-success');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle the error response and log details
                    console.error('Error toggling status:');
                    console.error('Status Code: ' + jqXHR.status);
                    console.error('Status Text: ' + textStatus);
                    console.error('Error Thrown: ' + errorThrown);

                    // You can also log the response text for more details
                    console.error('Response Text: ' + jqXHR.responseText);
                }
            });
        });
    });
</script>
