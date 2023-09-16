<x-master title="{{ __('My Objectives') }}">
    <x-navbar />

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
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
                <table class="table  " id="sortable-table">
                    <thead>
                        <tr>
                            <th data-sortable="true">No.</th>
                            <th data-sortable="true">Title</th>
                            <th data-sortable="true">Category</th>
                            <th data-sortable="true">Start Date</th>
                            <th data-sortable="true">Deadline</th>
                            <th data-sortable="true">Importance</th>
                            <th data-sortable="true">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objectives as $i => $objective)
                            <tr data-is-done="{{ $objective->is_done ? '1' : '0' }}">
                                <!-- Rest of your existing code for displaying objective details -->
                                <td
                                    class="{{ $objective->is_done ? 'text-decoration-line-through text-black-50' : '' }}">
                                    {{ $i + 1 }}</td>
                                <td
                                    class="{{ $objective->is_done ? 'text-decoration-line-through text-black-50' : '' }}">
                                    {{ $objective->title }}</td>
                                <td
                                    class="{{ $objective->is_done ? 'text-decoration-line-through text-black-50' : '' }}">
                                    {{ $objective->category->name }}</td>
                                <td
                                    class="{{ $objective->is_done ? 'text-decoration-line-through text-black-50' : '' }}">
                                    {{ $objective->start_date }}</td>
                                <td
                                    class="{{ $objective->is_done ? 'text-decoration-line-through text-black-50' : '' }}">
                                    {{ $objective->end_date }}</td>
                                <td
                                    class="{{ $objective->is_done ? 'text-decoration-line-through text-black-50' : '' }}">
                                    {{ $importanceLevels[$objective->importance] }}</td>
                                <td class="{{ $objective->is_done ? 'text-decoration-line-through text-black-50' : '' }}"
                                    id="statusCell_{{ $objective->id }}">
                                    @if ($objective->is_done)
                                        <span class="badge bg-success">✓ {{ __('Done') }}</span>
                                    @else
                                        <span class="badge bg-danger">✗ {{ __('Not Done') }}</span>
                                    @endif
                                </td>
                                <td class="{{ $objective->is_done ? '' : '' }}">

                                    <button
                                        class="btn btn-sm toggle-status {{ $objective->is_done ? 'btn-success' : 'btn-secondary' }}"
                                        data-objective="{{ $objective->id }}">
                                        <i
                                            class="fa-regular {{ $objective->is_done ? 'fa-thumbs-up' : 'fa-thumbs-down' }}"></i>
                                    </button>

                                    <a href="{{ route('objective.show', ['objective' => $objective->id]) }}"
                                        class="btn btn-info btn-sm" title="{{ __('View') }}"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('objective.edit', ['objective' => $objective->id]) }}"
                                        class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i
                                            class="fas fa-edit"></i></a>
                                    <form method="POST"
                                        action="{{ route('objective.destroy', ['objective' => $objective->id]) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-objective"
                                            title="{{ __('Delete') }}" data-objective-id="{{ $objective->id }}"
                                            onclick="confirmDelete('{{ route('objective.destroy', ['objective' => $objective->id]) }}')">
                                            <i class="fas fa-trash-alt"></i>
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
</x-master>

{{-- Data-Table Script --}}
<script>
    $(document).ready(function() {
        var table = $('#sortable-table').DataTable({
            "paging": true, // Enable pagination
            "pagingType": 'full_numbers', // Enable pagination
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
        $('#sortable-table tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            // alert('Clicked on row with title: ' + data[1]);
        });
    });
</script>
{{-- Toggle completion --}}
<script>
    $(document).ready(function() {


        $('.toggle-status').click(function() {
            var objectiveId = $(this).data('objective');
            var token = $('meta[name="csrf-token"]').attr(
                'content'); // Get the CSRF token from the meta tag

            $.ajax({
                type: 'POST',
                url: '/objective/' + objectiveId + '/toggleStatus',
                headers: {
                    'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
                },
                success: function(response) {
                    // Update the status in the table or perform any other desired actions
                    // You can add logic here to visually update the status in the table

                    console.log(response);
                    const $statusButton = $('.toggle-status[data-objective="' +
                        objectiveId + '"]');
                    const $statusCell = $('#statusCell_' + objectiveId);
                    const $tableRow = $statusCell.closest('tr');

                    if (response.is_done) {
                        $statusButton.removeClass('btn-secondary').addClass('btn-success');
                        $statusButton.find('i').removeClass('fa-thumbs-down').addClass(
                            'fa-thumbs-up');
                        $statusCell.html('<span class="badge bg-success">✓ Done</span>');
                        $tableRow.find('td:not(:last-child)').addClass(
                            'text-decoration-line-through text-black-50');
                        $tableRow.attr('data-is-done', '1');
                    } else {
                        $statusButton.removeClass('btn-success').addClass('btn-secondary');
                        $statusButton.find('i').removeClass('fa-thumbs-up').addClass(
                            'fa-thumbs-down');
                        $statusCell.html('<span class="badge bg-danger">✗ Not done</span>');
                        $tableRow.find('td:not(:last-child)').removeClass(
                            'text-decoration-line-through text-black-50');
                        $tableRow.attr('data-is-done', '0');
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

{{-- Delete Objective --}}
<script>
    $(document).ready(function() {
        $('.delete-objective').click(function() {
            var objectiveId = $(this).data('objective-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('objective.destroy', '') }}/' + objectiveId,

                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The objective has been deleted.',
                                icon: 'success'
                            }).then(() => {
                                // You can optionally reload the page or perform any other actions after deletion
                                window.location.reload();
                            });
                        },
                        error: function(error) {
                            console.error('Error deleting objective: ' + error
                                .statusText);
                        }
                    });
                }
            });
        });
    });
</script>

<x-footer />
