<x-master title="{{ __('Create Result') }}">
    <x-navbar />
    <div class="container">
        <h2>Create Result</h2>
        <form method="POST" action="{{ route('result.store') }}">
            @csrf

            <!-- Number Value Input (Hidden by default) -->
            <div class="form-group type-input" id="number-value-input" style="display: none;">
                <label for="number_value">Number Value:</label>
                <input type="text" name="number_value" id="number_value" class="form-control" />
            </div>

            <!-- Initial Time Input (Hidden by default) -->
            <div class="form-group type-input" id="initial-time-input" style="display: none;">
                <label for="initial_time">Initial Time:</label>
                <input type="text" name="initial_time" id="initial_time" class="form-control" />
            </div>

            <!-- Target Time Input (Hidden by default) -->
            <div class="form-group type-input" id="target-time-input" style="display: none;">
                <label for="target_time">Target Time:</label>
                <input type="text" name="target_time" id="target_time" class="form-control" />
            </div>

            <!-- Behavioral (Logic) Result Input (Hidden by default) -->
            <div class="form-group type-input" id="behavioral-result-input" style="display: none;">
                <label for="behavior_result">Behavior Result:</label>
                <input type="checkbox" name="behavior_result" id="behavior_result" class="form-check-input" />
            </div>


            <!-- Result Date -->
            <div class="form-group">
                <label for="result_date">Result Date:</label>
                <input type="date" name="result_date" id="result_date" class="form-control" />
            </div>

            <!-- Comment -->
            <div class="form-group">
                <label for="comment">Comment:</label>
                <input type="text" name="comment" id="comment" class="form-control" />
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <x-footer />

    <script>
$(document).ready(function() {
    // Function to show/hide input fields based on the selected type
    function toggleInputs(type) {
        $('.type-input').hide(); // Hide all type-specific input fields

        // Show the input fields based on the selected type
        if (type === 'number') {
            $('#number-value-input').show();
        } else if (type === 'time') {
            $('#initial-time-input').show();
            $('#target-time-input').show();
        } else if (type === 'behavioral') {
            $('#behavioral-result-input').show();
        }
    }

    // Event listener for the type select input
    $('#type').change(function() {
        var selectedType = $(this).val();
        toggleInputs(selectedType);
    });

    // Initialize the input fields based on the default type (if any)
    var initialType = $('#type').val();
    toggleInputs(initialType);
});
</script>

</x-master >
