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
                <table class="table" id="sortable-table">
                    <thead>
                        <tr>
                            <th data-sortable="true">No.</th>
                            <th data-sortable="true">Task Title</th>
                            <th data-sortable="true">Objective</th>
                            <th data-sortable="true">Date</th>
                            <th data-sortable="true">status</th>
                            <th data-sortable="true">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $i => $task)
                            <tr data-task-id="{{ $task->id }}">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->objective->title }}</td>
                                <td>{{ $task->date }}</td>
                                <td id="statusCell_{{ $task->id }}">
                                    @if ($task->is_done)
                                        <span class="badge bg-success">{{ __('✓ Done') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('✗ Not Done') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a data-toggle="modal" data-target="#taskModal"
                                        class="btn btn-info btn-sm view-task-btn" title="{{ __('View') }}"><i
                                            class="fas fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm edit-task-btn" title="{{ __('Edit') }}"><i
                                            class="fas fa-edit"></i></a>
                                    <form method="POST" {{ route('task.destroy', ['task' => $task->id]) }}"
                                        class="d-inline" id="deleteTaskForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-task-btn"
                                            data-task-id="{{ $task->id }}" title="{{ __('Delete') }}"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                    <button
                                        class="btn btn-sm toggle-status {{ $task->is_done ? 'btn-success' : 'btn-secondary' }}"
                                        data-task="{{ $task->id }}">
                                        <i
                                            class="fa-regular {{ $task->is_done ? 'fa-thumbs-up' : 'fa-thumbs-down' }}"></i>
                                    </button>


                                </td>

                            </tr>
                        @endforeach
                        {{-- modal show and edit  --}}
                        <x-task.show-task-details />
                        <x-task.edit-task :objectives='$objectives' />
                    </tbody>
                </table>
            </div>

            <div class="mt-5" id="calendar"></div>
            <div id="task-stats">
                <!-- Add task statistics here -->
            </div>
        @endif
    </div>

    <x-footer />
</x-master>

{{-- Toggle completion --}}
<script>
    $(document).ready(function() {
        $('.toggle-status').click(function() {
            var taskId = $(this).data('task');
            var token = $('meta[name="csrf-token"]').attr(
                'content'); // Get the CSRF token from the meta tag

            $.ajax({
                type: 'POST',
                url: '/task/' + taskId + '/toggleStatus',
                headers: {
                    'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
                },
                success: function(response) {
                    // Update the status in the table or perform any other desired actions
                    // You can add logic here to visually update the status in the table

                    console.log(response);
                    const $statusButton = $('.toggle-status[data-task="' + taskId + '"]');
                    const $statusCell = $('#statusCell_' + taskId);
                    const $tableRow = $statusCell.closest('tr');

                    if (response.is_done) {
                        $statusButton.removeClass('btn-secondary').addClass('btn-success');
                        $statusButton.find('i').removeClass('fa-thumbs-down').addClass(
                            'fa-thumbs-up');
                        $statusCell.html('<span class="badge bg-success">✓ Done</span>');
                        $tableRow.find('td:not(:last-child)').addClass(
                            'text-decoration-line-through text-black-50');
                    } else {
                        $statusButton.removeClass('btn-success').addClass('btn-secondary');
                        $statusButton.find('i').removeClass('fa-thumbs-up').addClass(
                            'fa-thumbs-down');
                        $statusCell.html('<span class="badge bg-danger">✗ Not done</span>');
                        $tableRow.find('td:not(:last-child)').removeClass(
                            'text-decoration-line-through text-black-50');
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

{{-- Data-Table Script --}}
<script>
    $(document).ready(function() {
        var table = $('#sortable-table').DataTable({
            "paging": true, // Enable pagination
            "pageLength": 10, // Number of records per page
            "ordering": true, // Enable column sorting
            "order": [
                [0, 'asc']
            ], // Default sorting column and order
            "searching": true, // Enable search
            "language": { // Localization
                "search": "Custom Search Text:",
                "paginate": {
                    "next": "Next Page",
                    "previous": "Previous Page"
                }
            },
            "columnDefs": [{
                "targets": [0], // Target the first column
                "visible": true, // Hide the first column
            }],
            "dom": 'lBfrtip', // Control the placement of components
            "buttons": [ // DataTables Buttons extension
                'copy', 'excel', 'pdf', 'print'
            ]
        });

        // Custom event example
        // $('#sortable-table tbody').on('click', 'tr', function() {
        //     var data = table.row(this).data();
        //     alert('Clicked on row with title: ' + data[1]);
        // });
    });
</script>

{{-- Delete button (edit and show are in respective task modals) --}}
<script>
    $('.delete-task-btn').on('click', function(e) {
        e.preventDefault();
        var taskId = $(this).data('task-id');

        Swal.fire({
            title: 'Are you sure ?',
            text: 'You are about to delete this task. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('task.destroy', '') }}/' + taskId,

                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'DELETE'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The task has been deleted.',
                            icon: 'success'
                        }).then(() => {
                            // You can optionally reload the page or perform any other actions after deletion
                            window.location.reload();
                        });
                    },
                    error: function(error) {
                        console.error('Error deleting task: ' + error.statusText);
                    }
                });
            }
        });
    });
</script>

{{-- Calendar --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        })
        calendar.render()
    })
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // Add your FullCalendar options here (e.g., initialView, eventClick, etc.)
         eventRender: function (info) {
            // Check if the task is completed
            if (info.event.extendedProps.completed) {
                var dayNumber = info.el.querySelector('.fc-day-number');
                var circle = document.createElement('div');
                circle.className = 'completed-circle';
                dayNumber.appendChild(circle);
            }
        }
           
        });

        calendar.render(); // Render the calendar

        // Fetch tasks and populate events on the calendar
        // $.ajax({
        //     url: '{{ route('task.json') }}', // Use the route for the getTasksJson function
        //     type: 'GET',
        //     success: function(response) {
        //         // Process tasks data and add them as events on the calendar
        //         // For each task, create an event object and add it to the calendar
        //         var events = response.map(function(task) {
        //             return {
        //                 title: task.title,
        //                 start: task.date,
        //                 backgroundColor: task.isDone ? 'green' :
        //                 'red', // Customize colors based on task completion
        //             };
        //         });

        //         calendar.addEventSource(events);

        //         // Add logic to update task statistics here
        //         updateTaskStatistics(response);
        //     },
        //     error: function(xhr) {
        //         console.error(xhr.responseText);
        //     },
        // });

        // Function to update task statistics
        function updateTaskStatistics(tasks) {
            var totalTasks = tasks.length;
            var completedTasks = tasks.filter(function(task) {
                return task.isDone;
            }).length;
            var completionPercentage = totalTasks === 0 ? 0 : (completedTasks / totalTasks) * 100;

            $('#task-stats').html(`
                <p>Total Tasks: ${totalTasks}</p>
                <p>Completed Tasks: ${completedTasks}</p>
                <p>Completion Percentage: ${completionPercentage.toFixed(2)}%</p>
            `);
        }
    });
</script>
