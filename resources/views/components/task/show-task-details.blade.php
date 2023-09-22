<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">{{ __('Task Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h5 class="card-title" id="task_title"></h5>
                <p class="card-text mt-3"><strong>{{ __('Description:') }} </strong><span id="task_description"></span>
                </p>
                <p class="card-text"><strong>{{ __('Related Objective:') }}</strong> <span
                        id="task_objective_title"></span> </p>
                <p class="card-text"><strong>{{ __('Date:') }}</strong> <span id="task_date"></span> </p>
                <p class="card-text"><strong>{{ __('Created At:') }}</strong> <span id="created_at"></span></p>
                <p class="card-text"><strong>{{ __('Updated At:') }}</strong> <span id="updated_at"></span></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    // show 
    $(document).ready(function() {
        $('.view-task-btn').click(function() {
            // Get the task ID from the data attribute
            var taskId = $(this).closest('tr').data('task-id') ?? $(this).data('task-id');

            // Fetch task data via AJAX
            $.ajax({
                url: '/task/' + taskId,
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    // Populate modal with fetched data
                    $('#task_title').text(response.title);
                    $('#task_description').text(response.description ?? "{{__('No description')}}");
                    $('#task_objective_title').text(response.objective.title);
                    $('#task_date').text(response.date);

                    var createdAt = new Date(response.created_at);
                    var updatedAt = new Date(response.updated_at);

                    // Format date and time
                    var createdAtFormatted = createdAt.toLocaleDateString() + ' ' +
                        createdAt.toLocaleTimeString();
                    var updatedAtFormatted = updatedAt.toLocaleDateString() + ' ' +
                        updatedAt.toLocaleTimeString();

                    $('#created_at').text(createdAt);
                    $('#updated_at').text(updatedAt);

                },
                error: function(xhr) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
