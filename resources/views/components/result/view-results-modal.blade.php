@props(['objective'])
<div class="modal fade" id="viewResultsModal" tabindex="-1" aria-labelledby="viewResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewResultsModalLabel">View Results for {{ $objective->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="sortable-table">
                    <thead>
                        <tr>

                            <th data-sortable="true">Result Date</th>
                            @if ($objective->type === 'number')
                                <th data-sortable="true">Target Number</th>
                            @endif
                            @if ($objective->type === 'time')
                                <th data-sortable="true">Experience Time</th>
                            @endif
                            @if ($objective->type === 'behavioral')
                                <th data-sortable="true">Behavioral Result </th>
                                <th data-sortable="true">planning type </th>
                            @endif
                            <th data-sortable="true">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objective->results as $result)
                            <tr data-result-id="{{ $result->id }}">
                                <td>{{ $result->result_date }}</td>
                                @if ($objective->type === 'number')
                                    <td>{{ $result->number_value }}</td>
                                @endif
                                @if ($objective->type === 'time')
                                    <td>{{ $result->experience_time_value }}</td>
                                @endif
                                @if ($objective->type === 'behavioral')
                                    <td>{{ $result->behavior_result ? "Make it a habit" :"Quit Habit" }}</td>
                                    <td>{{ $result->objective->planning->planningType->name  }}</td>
                                @endif
                              

                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        title="{{ __('Edit') }}" data-bs-target="#editResultModal"
                                        data-result-id="{{ $result->id }}"
                                        data-objective-type="{{ $objective->type }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" class="d-inline" id="deleteResultForm"
                                        data-result-id="{{ $result->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-result-btn"
                                            data-result-id="{{ $result->id }}" title="{{ __('Delete') }}"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Data-Table Script --}}
<script>
    $(document).ready(function() {
        var table = $('#sortable-table').DataTable({
            "paging": true, // Enable pagination
            "pageLength": 5, // Number of records per page
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


    });
</script>


{{-- Delete button (edit and show are in respective result modals) --}}
<script>
    $('.delete-result-btn').on('click', function(e) {
        e.preventDefault();
        var resultId = $(this).data('result-id');

        Swal.fire({
            title: 'Are you sure ?',
            text: 'You are about to delete this result. This action cannot be undone.',
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
                    url: '{{ route('result.destroy', '') }}/' + resultId,

                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'DELETE'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The result has been deleted.',
                            icon: 'success'
                        }).then(() => {
                            // You can optionally reload the page or perform any other actions after deletion
                            $(`tr[data-result-id="${response.result_id}"]`)
                                .remove();

                        });
                    },
                    error: function(error) {
                        console.error('Error deleting result: ' + error.statusText);
                    }
                });
            }
        });
    });
</script>
