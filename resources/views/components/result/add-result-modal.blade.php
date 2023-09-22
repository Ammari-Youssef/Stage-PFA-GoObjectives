@props(['objective'])
<div class="modal fade" id="addResultModal" tabindex="-1" aria-labelledby="addResultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addResultForm" method="POST" action="{{ route('result.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addResultModalLabel">Add Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="objective_id" value="{{$objective->id}}">
                <div class="modal-body">
                    <!-- Type-dependent input fields -->
                    @if ($objective->type === 'number')
                        <!-- Number input -->
                        <!-- Display the target number value -->
                        <div class="mb-3">
                            <label for="targetNumberValue" class="form-label">Target Number Value</label>
                            <input type="text" class="form-control" id="targetNumberValue" name="target_number_value"
                                value="{{ $objective->number_value }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="resultValue" class="form-label">Result Value</label>
                            <input type="number" class="form-control" id="resultValue" name="number_value" step="0.01">
                        </div>
                    @elseif ($objective->type === 'time')
                     <!-- Display the target time value -->
                    <div class="mb-3">
                        <label for="targetTimeValue" class="form-label">Target Time Value</label>
                        <input type="text" class="form-control" id="targetTimeValue" name="target_time_value"
                        value="{{ $objective->target_time }}" readonly>
                    </div>
                    <!-- Time input -->
                        <div class="mb-3">
                            <label for="resultTime" class="form-label">Result Time</label>
                            <input type="time" class="form-control" id="resultTime" name="experience_time_value">
                        </div>
                    @elseif ($objective->type === 'behavioral')
                        <!-- Display the target behavioral value -->
                        <div class="mb-3">
                            <label for="targetBehaviorValue" class="form-label">Target Behavioral Value</label>
                            <input type="text" class="form-control" id="targetBehaviorValue"
                                name="target_behavior_value" value="{{ $objective->behavior_option ? 'Do '. $objective->title : 'Do not do' .$objective->title }}" readonly>
                        </div>
                        <!-- Behavioral radio buttons -->
                        <div class="mb-3">
                            <label>Did it?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="behavior_result" id="didItYes"
                                    value="1">
                                <label class="form-check-label" for="didItYes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="behavior_result" id="didItNo"
                                    value="0">
                                <label class="form-check-label" for="didItNo">No</label>
                            </div>
                        </div>
                    @endif

                    <!-- Common input fields -->
                    <div class="mb-3">
                        <label for="resultDate" class="form-label">Result Date</label>
                        <input type="date" class="form-control" id="resultDate" name="result_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="resultComment" class="form-label">Comment (optional)</label>
                        <textarea class="form-control" id="resultComment" name="comment" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitResult">Add Result <i class="fa-solid fa-plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#submitResult').on('click', function() {
            var resultData = {
                objective_type: '{{ $objective->type }}',
                objective_id: '{{ $objective->id }}',
                number_value: $('#resultValue').val(),
                experience_time_value: $('#resultTime').val(),
                behavior_result: $('input[name="behavior_result"]:checked').val(),
                result_date: $('#resultDate').val(),
                comment: $('#resultComment').val(),
            };

            // Send the result data to the server using AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('result.store') }}',
                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      
                data: resultData,
                success: function(response) {
                    console.log(response);
                    // Handle success, e.g., close the modal, refresh the results list, etc.
                    $('#addResultModal').modal('hide');

                    window.location.reload();
                 
                },
                error: function(xhr) {
                    // Handle errors, e.g., display an error message
                    console.error(xhr.responseText);
                },
            });
        });
    });
</script>
