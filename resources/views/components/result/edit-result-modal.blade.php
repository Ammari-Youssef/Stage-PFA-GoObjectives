<!-- Edit Result Modal -->
<div class="modal fade" id="editResultModal" tabindex="-1" aria-labelledby="editResultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editResultForm" method="POST" data-result-id="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editResultModalLabel">Edit Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="objective_id" class="objectiveId" value="">
                <input type="hidden" name="objective_type" id="objectiveType" value="">
                <div class="modal-body">
                    <!-- Number input -->
                    <div class="mb-3 number-input">
                        <label for="resultValue" class="form-label">Result Value</label>
                        <input type="number" class="form-control resultValue" id="resultValue" name="number_value"
                            step="0.01">
                    </div>

                    <!-- Time input -->
                    <div class="mb-3 time-input">
                        <label for="resultTime" class="form-label">Result Time</label>
                        <input type="time" class="form-control resultTime" id="resultTime"
                            name="experience_time_value">
                    </div>

                    <!-- Behavioral radio buttons -->
                    <div class="mb-3 behavioral-input">
                        <label>Did it?</label>
                        <div class="form-check">
                            <input class="form-check-input didItYes" type="radio" name="behavior_result"
                                id="didItYes" value="1">
                            <label class="form-check-label" for="didItYes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input didItNo" type="radio" name="behavior_result" id="didItNo"
                                value="0">
                            <label class="form-check-label" for="didItNo">No</label>
                        </div>
                    </div>

                    <!-- Common input fields -->
                    <div class="mb-3">
                        <label for="resultDate" class="form-label">Result Date</label>
                        <input type="date" class="form-control resultDate" id="resultDate" name="result_date">
                    </div>

                    <div class="mb-3">
                        <label for="resultComment" class="form-label">Comment (optional)</label>
                        <textarea class="form-control resultComment" id="resultComment" name="comment" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEditResultForm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript Script -->
<script>
    $('.number-input, .time-input, .behavioral-input').hide(); // Hide all input fields first
    // Function to show/hide input fields based on objective type
    function toggleInputFields(objectiveType) {
        if (objectiveType === 'number') {
            $('.number-input').show();
        } else if (objectiveType === 'time') {
            $('.time-input').show();
        } else if (objectiveType === 'behavioral') {
            $('.behavioral-input').show();
        }
    }

    function populateModal(result) {
        $('#objectiveType').val(result.objective.type);
        $('.objectiveId').val(result.objective.id);
        $('#editResultForm').attr('data-result-id', result.id);
        // Populate common fields
        $('.resultDate').val(result.result_date);
        $('.resultComment').val(result.comment);

        if (result.objective.type == 'number') {
            $('.resultValue').val(result.number_value);
        } else if (result.objective.type == 'time') {
            $('.resultTime').val(result.experience_time_value);
        } else if (result.objective.type == 'behavioral') {
            if (result.behavior_result == 1) {
                $('.didItYes').prop('checked', true);
            } else {
                $('.didItNo').prop('checked', true);
            }
        }
    }
    $(document).ready(function() {
        // When the modal is opened
        $('#editResultModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var objectiveType = button.data('objective-type'); // Get the objective type from the button

            // Populate the modal with the correct data (you'll need to fetch this data using AJAX)
            var resultId = button.data('result-id'); // Get the result ID from the button

            // Assuming you fetch the result data using AJAX, populate the modal fields here based on the resultId
            $.ajax({
                url: '/result/' + resultId,
                method: 'GET',
                success: (response) => {
                    console.log("response ", response);
                    // console.log("obj type ", response.result.objective.type);
                    // console.log("obj id ", response.result.objective.id);
                    // console.log('result.number_value :', response.result.number_value);
                    // console.log('result time_value :', response.result
                    //     .experience_time_value);
                    populateModal(response.result);
                    // Show/hide input fields based on the objective type
                    toggleInputFields(response.result.objective.type);

                },
                error:(err)=>{console.log(err)}
            });

            // Set the objective type value in the hidden input field
            // $('#objectiveType').val(objectiveType);
        });

        // When the modal is closed
        $('#editResultModal').on('hide.bs.modal', function() {
            // Clear the modal input fields
            $('#editResultForm')[0].reset();
        });

        // Handle form submission
        $('#submitEditResultForm').on('click', function(event) {
            event.preventDefault();
            var formData = $('#editResultForm').serialize();
            var resultId = $('#editResultForm').data('result-id');
            console.log(resultId)
            console.log(formData)

            // Submit the form using AJAX, you'll need to include the relevant AJAX code here
            $.ajax({
                url: '/result/' + resultId,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                type: 'PUT',
                data: formData,
                success: function(response) {
                    // Handle the success response (e.g., close the modal, update task display)
                    console.log('submit response ', response);
                    Swal.fire({
                        title: 'Success',
                        text: 'Result updated successfully',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                    }).then(() => {
                        // Refresh the page without reloading
                        // Hide the modal
                        $('#editResultModal').modal('hide');
                        location.reload();
                        
                    });

                },
                error: function(xhr) {
                    // Handle any errors that occur during the request
                    console.error(xhr.responseText);
                },
            });


        });
    });
</script>
