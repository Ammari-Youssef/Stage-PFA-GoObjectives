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

                                    <form method="POST" class="d-inline" id="deleteTaskForm">
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


            <div class="container mt-4">
                <h3>Task Progress</h3>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="progress-label">0%</p>
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
    function updateProgressBar(completedTasks, totalTasks) {
        var percentage = totalTasks != 0 ? (completedTasks / totalTasks) * 100 : 0;
        var progressBar = document.querySelector('.progress-bar');
        var progressLabel = document.querySelector('.progress-label');

        progressBar.style.width = percentage + '%';
        progressBar.setAttribute('aria-valuenow', percentage);
        progressLabel.textContent = completedTasks + ' tasks done out of ' + totalTasks +
            ' tasks this month ' +
            percentage.toFixed(2) + '%';
        progressBar.textContent = percentage.toFixed(2) + '%';
        progressLabel.classList.remove('sr-only'); // Show the label
    }
    //Perform an AJAX request to your server endpoint to get updated task counts
    function toggleUpdate() {
        $.ajax({
            url: '{{ route('task.counts') }}',
            type: 'GET',

            success: function(response) {
                console.log("fetsh res", response)
                // Update the progress bar with the new percentage
                updateProgressBar(response.completedTasks, response.totalTasks);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            },
        });
    }

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
                    //Make a line through all the row 
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
                        toggleUpdate();
                    } else {
                        $statusButton.removeClass('btn-success').addClass('btn-secondary');
                        $statusButton.find('i').removeClass('fa-thumbs-up').addClass(
                            'fa-thumbs-down');
                        $statusCell.html('<span class="badge bg-danger">✗ Not done</span>');
                        $tableRow.find('td:not(:last-child)').removeClass(
                            'text-decoration-line-through text-black-50');
                        toggleUpdate();
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
                            $(`tr[data-task-id="${response.task_id}"]`).remove();

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
<script>
    //Set Calendar with the dates 
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Display a month view
            events: {
                url: '/api/tasks', // Replace with your API endpoint
                method: 'GET',
                extraParams: {
                    // You can include additional parameters if needed
                },
                failure: function() {
                    alert('Failed to load tasks.');
                }
            },

        });

        // fonction qui mise à jour la barre du progrés 
        function updateProgressBar(completedTasks, totalTasks) {
            var percentage = totalTasks != 0 ? (completedTasks / totalTasks) * 100 : 0;
            var progressBar = document.querySelector('.progress-bar');
            var progressLabel = document.querySelector('.progress-label');

            progressBar.style.width = percentage + '%';
            progressBar.setAttribute('aria-valuenow', percentage);
            progressLabel.textContent = completedTasks + ' tasks done out of ' + totalTasks +
                ' tasks this month ' +
                percentage.toFixed(2) + '%';
            progressBar.textContent = percentage.toFixed(2) + '%';
            progressLabel.classList.remove('sr-only'); // Show the label
        }
        // Function to fetch and update the percentage
        function fetchAndUpdatePercentage(start, end) {
            var startOfMonth = new Date(start);
            var endOfMonth = new Date(end);

            // Convert to ISO 8601 date strings
            var startOfMonthISO = startOfMonth.toISOString();
            var endOfMonthISO = endOfMonth.toISOString();

            $.ajax({
                url: '{{ route('task.counts') }}',
                type: 'GET',
                data: {
                    startOfMonth: startOfMonthISO,
                    endOfMonth: endOfMonthISO,
                },
                success: function(response) {
                    console.log("fetsh res", response)
                    // Update the progress bar with the new percentage
                    updateProgressBar(response.completedTasks, response.totalTasks);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                },
            });
        }

        // Fetch and update the percentage when the calendar initially loads
        calendar.on('datesSet', function(info) {
            console.log("on cal info", info)
            var viewStart = info.view.activeStart;
            var viewEnd = info.view.activeEnd;

            // Calculate the 1st day of the current month
            var startOfMonth = new Date(viewStart.getFullYear(), viewStart.getMonth()
            , 1);

            // Calculate the end of the current month
            var endOfMonth = new Date(viewEnd.getFullYear(), viewEnd.getMonth(),
            0); // Day 0 is the last day of the previous month
            console.log('startOfMonth', startOfMonth)
            console.log('endOfMonth', endOfMonth)
            // Fetch and update the percentage for the current month
            fetchAndUpdatePercentage(startOfMonth, endOfMonth);

        });

        // Fetch and update the percentage whenever the month changes
        calendar.on('dateClick', function(info) {
            console.log("month change info", info)

            var month = info.date.getMonth() + 1;

            var viewStart = info.view.activeStart;
            var viewEnd = info.view.activeEnd;

            // Calculate the 1st day of the current month
            var startOfMonth = new Date(viewStart.getFullYear(), viewStart.getMonth(), 1);

            // Calculate the end of the current month
            var endOfMonth = new Date(viewEnd.getFullYear(), viewEnd.getMonth(), 0);

            // Change the calendar's view to the selected month
            calendar.gotoDate(info.date);

            // Fetch and update the percentage for the selected month
            fetchAndUpdatePercentage(startOfMonth, endOfMonth);
        });
        calendar.render(); // Render the calendar


        // Initial update with the values from the server
        // var completedTasks = {{ $completedTaskCount }};
        // var totalTasks = {{ $TaskCount }};
        // updateProgressBar(completedTasks, totalTasks);

        // // Set up a setInterval to periodically update the progress
        // var updateInterval = 3000; // Update every minute (adjust as needed)
        // setInterval(function() {

        //     // Perform an AJAX request to your server endpoint to get updated task counts
        //     $.ajax({
        //         url: '{{ route('task.counts') }}', // Replace with your server endpoint URL
        //         type: 'GET',
        //         dataType: 'json', // Assume the response is in JSON format
        //         success: function(response) {
        //             // Assuming the server returns an object with 'completedTasks' and 'totalTasks' properties
        //             console.log(response)
        //             var completedTasks = response.completedTasks;
        //             var totalTasks = response.totalTasks;

        //             // Update the progress bar with the new counts
        //             updateProgressBar(completedTasks, totalTasks);
        //         },
        //         error: function(xhr) {
        //             console.error('Failed to fetch updated counts: ' + xhr.responseText);
        //         }
        //     });

        // }, updateInterval);


    });
</script>
