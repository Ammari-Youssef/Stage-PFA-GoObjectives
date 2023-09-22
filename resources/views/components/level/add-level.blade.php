@props(['objective'])
<div class="modal fade" id="addLevelModal" tabindex="-1" aria-labelledby="addLevelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLevelModalLabel">Add Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Level form goes here -->
                <form id="addLevelForm">
                    @csrf
                    <div class="mb-3">
                        <label for="levelTitle" class="form-label">Level Title</label>
                        <input type="text" class="form-control" id="levelTitle" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="levelDescription" class="form-label">Level Description</label>
                        <textarea class="form-control" id="levelDescription" name="description"></textarea>
                    </div>
                    <input type="text" id="objectiveId" name="objective_id" value="{{ $objective->id }}">
                    <input type="text" id="planningId" name="planning_id" value="{{ $objective->planning->id }}">
                    <button type="submit" class="btn btn-primary">Add Level</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#addLevelForm').submit(function(event) {
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();

            // Submit the form via AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('level.store') }}', // Adjust the route to your controller method
                data: formData,
                success: function(response) {
                    console.log(response)
                    // Handle the success response, e.g., close the modal
                    $('#addLevelModal').modal('hide');
                     window.location.reload();
                    // Optionally, update the view to show the newly added levels
                    // You can append the new levels to a list on your page
                },
                error: function(xhr) {
                    // Handle errors, e.g., display an error message
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
