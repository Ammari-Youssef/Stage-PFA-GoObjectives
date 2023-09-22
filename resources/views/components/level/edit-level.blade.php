<div class="modal fade" id="editLevelModal" tabindex="-1" aria-labelledby="editLevelModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLevelModalLabel">Edit Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Level form goes here -->
                <form id="editLevelForm" method="POST" data-level-id>
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="levelTitle" class="form-label">Level Title</label>
                        <input type="text" class="form-control" id="levelTitle" name="title"
                            value="">
                    </div>
                    <div class="mb-3">
                        <label for="levelDescription" class="form-label">Level Description</label>
                        <textarea class="form-control" id="levelDescription" name="description"></textarea>
                    </div>
                    <input type="hidden" id="levelId" name="level_id" value="">
                    <button type="submit" class="btn btn-primary " id="submitEditLevel">Update Level</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
      function populateEditLevelModal(Level) {
        $('#levelTitle').val(Level.title);
        $('#levelDescription').val(Level.description);
            // Set the data-Level-id attribute and hidden input value
    $('#editLevelForm').attr('data-level-id', Level.id);
    $('#levelId').val(Level.id); 
    }

    // When the edit button is clicked, populate the modal and show it
    $('.edit-Level-btn').on('click', function() {
        var LevelId = $(this).data('level-id');
         $('#editLevelForm').attr('data-level-id', LevelId);
        console.log('LevelId', LevelId)
        $.ajax({
            url: '/level/' + LevelId,
            type: 'GET',
            success: function(response) {
                console.log('level : ' , response)
                populateEditLevelModal(response);
                $('#editLevelModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            },
        });
    });
    // Handle the form submission when the "Edit level" button is clicked
    $('#submitEditLevel').on('click', function(e) {
        
        e.preventDefault();
        
        // Get the form data and submit it with AJAX
        var formData = $('#editLevelForm').serialize();
        var levelId = $('#editLevelForm').data('level-id');

    console.log(levelId)
    // console.log(formData)
    
    let title = $('#levelTitle').val();
    let description = $('#levelDescription').val();
    
    $.ajax({
        url: '/level/' + levelId ,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'PUT', 
        data:formData,
        success: function(response) {
            // Handle the success response (e.g., close the modal, update level display)
            console.log('submit response ',response);
            Swal.fire({
            title: 'Success',
            text: response.message,
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
        }).then(() => {
            // Refresh the page without reloading
            location.reload();
        });

        // Hide the modal
         $('#editLevelModal').modal('hide');
        },
        error: function(xhr) {
            // Handle any errors that occur during the request
            console.error(xhr.responseText);
        },
    });
});
</script>
