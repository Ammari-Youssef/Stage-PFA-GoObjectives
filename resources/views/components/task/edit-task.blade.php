@props(['objectives'])
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">{{ __('Edit Task') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editTaskForm" data-task-id="">
                    @csrf
                    @method('PUT')
                     <input type="hidden" name="task_id" id="task_id" value="">
                    <div class="mb-3">
                        <label for="eobjective_id" class="form-label">{{ __('Select Objective') }}</label>
                        <select class="form-select" id="eobjective_id" name="objective_id" >
                            <option value="" disabled>{{ __('Select an Objective') }}</option>
                            @foreach ($objectives as $objective)
                                <option value="{{ $objective->id }}">{{ $objective->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="etask_title" class="form-label">{{ __('Task Title') }}</label>
                        <input type="text" class="form-control" id="etask_title" name="title" >
                    </div>
                    <div class="mb-3">
                        <label for="etask_description" class="form-label">{{ __('Task Description') }}</label>
                        <textarea class="form-control" id="etask_description" name="description" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="etask_date" class="form-label">{{ __('Task Date') }}</label>
                        <input type="date" class="form-control" id="etask_date" name="date" >
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitEditTask" >{{ __('Edit Task') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    function populateEditTaskModal(task) {
        $('#eobjective_id').val(task.objective_id);
        $('#etask_title').val(task.title);
        $('#etask_description').val(task.description);
        $('#etask_date').val(task.date);
            // Set the data-task-id attribute and hidden input value
    $('#editTaskForm').attr('data-task-id', task.id);
    $('#task_id').val(task.id);
    }

    // When the edit button is clicked, populate the modal and show it
    $('.edit-task-btn').on('click', function() {
        var taskId = $(this).closest('tr').data('task-id');
        //  $('#editTaskForm').attr('data-task-id', taskId);
        console.log('taskId', taskId)
        $.ajax({
            url: '/task/' + taskId,
            type: 'GET',
            success: function(response) {
                populateEditTaskModal(response);
                $('#editTaskModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            },
        });
    });
    
    // Handle the form submission when the "Edit Task" button is clicked
    $('#submitEditTask').on('click', function(e) {
        
        e.preventDefault();
        
        // Get the form data and submit it with AJAX
        var formData = $('#editTaskForm').serialize();
        var taskId = $('#editTaskForm').data('task-id');

    console.log(taskId)
    console.log(formData)
    
    // let title = $('#etask_title').val();
    // let description = $('#edescription').val();
    // let date = $('#edate').val();
    // let objective_id = $('#eobjective_id').val();
    
    $.ajax({
        url: '/task/' + taskId ,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'PUT', 
        data:formData,
        success: function(response) {
            // Handle the success response (e.g., close the modal, update task display)
            console.log('submit response ',response);
            Swal.fire({
            title: 'Success',
            text: response.message,
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
        }).then(() => {
            // Refresh the page without reloading
            // location.reload();
        });

        // Hide the modal
         $('#editTaskModal').modal('hide');
        },
        error: function(xhr) {
            // Handle any errors that occur during the request
            console.error(xhr.responseText);
        },
    });
});

// $('#editTaskForm').submit((e)=>{
//     e.preventDefault();

// })
</script>
