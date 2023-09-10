@props(['modalId', 'modalLabel', 'formAction', 'inputName', 'rating', 'id'])

@php
    // Replace special characters and spaces with underscores
    $escapedInputName = str_replace(['&', ' ', "'", '"'], '_', $inputName);
@endphp

<div x-data="{ value: {{ $rating }} }" class="modal fade modalEdit" id="{{ $modalId }}" tabindex="-1"
    aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">Edit Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ $formAction }}" method="POST" data-progress-id="{{ $id }}"
                    id="edit_modal_form">
                    @csrf
                    {{-- @method('PUT') --}}

                    <!-- Input for Editing Progress Rating -->
                    <div class="mb-3">
                        <label for="{{ $escapedInputName }}">{{ $inputName }}</label>

                        <input x-model="value" type="range" class="form-range" id="{{ $escapedInputName }}"
                            name="rating" value="{{ $rating }}" min="0" max="10" step="0.25">
                        <!-- Display the chosen value next to the input -->
                        <span id="{{ $escapedInputName }}Value" x-text="value"
                            name="{{ $rating }}">{{ $rating }} </span>
                    </div>

                    <!-- Hidden Input for Progress ID -->
                    <input type="hidden" name="progress_id" value="{{ $id }}">

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" id="edit_btn">Save Changes</button>
                </form>

            </div>
        </div>
    </div>
</div>


{{-- update the value of categories in rating <span> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the input and the span displaying the chosen value
        const input = document.getElementById('{{ $escapedInputName }}');
        const valueSpan = document.getElementById('{{ $escapedInputName }}Value');

        // Add an event listener to the input for input changes
        input.addEventListener('input', function() {
            // Update the <span> with the chosen value
            valueSpan.textContent = input.value;

            // Update the corresponding value in the window object
            window['{{ $escapedInputName }}_value'] = input.value;
        });
    });
</script>