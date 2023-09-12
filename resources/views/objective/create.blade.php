<x-master title="{{ __('Create New Objective') }}">
    <x-navbar />

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Create New Objective</h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('objective.store') }}" method="POST">
                            @csrf
                            {{-- In case the objective is sub-target --}}
                            <input type="hidden" name="objective_parent_id" value="{{ $objective_parent_id ?? null }}">

                            {{-- Title --}}
                            <div class="mb-3">
                                <label for="title">{{ __('Objective Title') }}</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Desscription --}}
                            <div class="mb-3">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Category --}}
                            <div class="mb-3">
                                <label for="category_id">{{ __('Category') }}</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>{{ __('Select a category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                            title="{{ $category->description }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Desired Result --}}
                            <div class="mb-3">
                                <label>{{ __('Desired Result') }}</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="desired_result"
                                            id="improve" value="1"
                                            {{ old('desired_result') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="improve">{{ __('Improve') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="desired_result"
                                            id="remove" value="0"
                                            {{ old('desired_result') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remove">{{ __('Remove') }}</label>
                                    </div>
                                </div>
                                @error('desired_result')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Type goal --}}
                            <div class="mb-3">
                                <label for="objective_type">{{ __('Type of Objective') }}</label>
                                <select class="form-select" id="objective_type" name="type">
                                    <option value="" disabled selected>Choose Nature of Objective</option>
                                    <div class="form-group">

                                        <option value="number" {{ old('type') == 'number' ? 'selected' : '' }}>
                                            {{ __('Number') }}
                                        </option>
                                        <option value="time" {{ old('type') == 'time' ? 'selected' : '' }}>
                                            {{ __('Time') }}
                                        </option>
                                        <option value="behavioral" {{ old('type') == 'behavioral' ? 'selected' : '' }}>
                                            {{ __('Behavioral (Logic)') }}</option>
                                        <option value="essential" {{ old('type') == 'essential' ? 'selected' : '' }}>
                                            {{ __('Essential') }} </option>


                                    </div>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div id="numberFields" style="display: none;">
                                    <label for="number_value">{{ __('Number Value') }}</label>
                                    <input type="number" class="form-control" id="number_value" name="number_value"
                                        value="{{ old('number_value') }}" min="0" step="0.01">
                                    @error('number_value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="behavioralFields" style="display: none;">
                                    <label>{{ __('Choose an option') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="behavior_option"
                                            id="behavior_option_do" value="1"
                                            {{ old('behavior_option') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="behavior_option_do">
                                            Do It
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="behavior_option"
                                            id="behavior_option_dont" value="0"
                                            {{ old('behavior_option') == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="behavior_option_dont">
                                            Don't Do It
                                        </label>
                                    </div>
                                    @error('behavior_option')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="timeFields" style="display: none;">
                                    <label for="initial_time">{{ __('Initial Duration (minutes)') }}</label>
                                    <input type="time" class="form-control" id="initial_time" name="initial_time"
                                        value="{{ old('initial_time') }}">
                                    @error('initial_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <label for="target_time">{{ __('Target Duration (minutes)') }}</label>
                                    <input type="time" class="form-control" id="target_time" name="target_time"
                                        value="{{ old('target_time') }}">
                                    @error('target_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="essentialFields" style="display: none;">
                                    <p class="alert alert-info">
                                        {{ __('You can create subobjectives for this goal later.') }}</p>
                                </div>
                            </div>
                            {{-- Importance --}}
                            <div class="mb-3">
                                <label for="importance">{{ __('Importance') }}</label>
                                <input type="range" class="form-range" min="1" max="5"
                                    id="importance" name="importance" value="{{ old('importance') }}" required>
                                <div class="text-center">
                                    <span id="importanceValue">{{ old('importance') ?: 'Choose importance' }}</span>
                                </div>
                                @error('importance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Repeat for other input fields -->


                            {{-- Start date --}}
                            <div class="mb-3">
                                <label for="start_date">{{ __('Start Date') }}</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Duree Estimee --}}
                            <div class="mb-3">
                                <label for="estimated_duration">{{ __('Estimated Duration') }}</label>
                                <select class="form-select" id="estimated_duration" name="estimated_duration"
                                    required>
                                    <option value="1_week"
                                        {{ old('estimated_duration') == '1_week' ? 'selected' : '' }}>
                                        {{ __('1 week') }}</option>
                                    <option value="2_weeks"
                                        {{ old('estimated_duration') == '2_weeks' ? 'selected' : '' }}>
                                        {{ __('2 weeks') }}
                                    </option>
                                    <option value="1_month"
                                        {{ old('estimated_duration') == '1_month' ? 'selected' : '' }}>
                                        {{ __('1 month') }}
                                    </option>
                                    <option value="2_months"
                                        {{ old('estimated_duration') == '2_months' ? 'selected' : '' }}>
                                        {{ __('2 months') }}</option>
                                    <option value="3_months"
                                        {{ old('estimated_duration') == '3_months' ? 'selected' : '' }}>
                                        {{ __('3 months') }}</option>
                                    <option value="6_months"
                                        {{ old('estimated_duration') == '6_months' ? 'selected' : '' }}>
                                        {{ __('6 months') }}</option>
                                    <option value="1_year"
                                        {{ old('estimated_duration') == '1_year' ? 'selected' : '' }}>
                                        {{ __('1 year') }}</option>
                                </select>
                                @error('estimated_duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            {{-- End date --}}
                            <div class="mb-3">
                                <label for="end_date">{{ __('End Date') }}</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- planning --}}
                            <div class="mb-3">
                                <label for="planning_type_id">{{ __('Planning') }}</label>
                                <select class="form-select" id="planning_type_id" name="planning_type_id"
                                    onchange="showPlanningOptions(this.value)">
                                    <option value="" disabled selected>{{ __('Select Planning Type') }}</option>
                                    @foreach ($planningTypes as $tplan)
                                        <option value="{{ $tplan->id }}"
                                            {{ old('planning_type_id') == $tplan->id ? 'selected' : '' }}>
                                            {{ $tplan->name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('planning_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- weekly planning --}}
                            <div id="weeklyOptions" style="display: none;">
                                <div class="mb-3">
                                    <label for="weeklyDays">{{ __('Select Weekly Days') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="monday"
                                            name="selected_week_days[]" value="monday"
                                            {{ in_array('monday', old('selected_week_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="monday">{{ __('Monday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tuesday"
                                            name="selected_week_days[]" value="tuesday"
                                            {{ in_array('tuesday', old('selected_week_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tuesday">{{ __('Tuesday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wednesday"
                                            name="selected_week_days[]" value="wednesday"
                                             {{ in_array('wednesday', old('selected_week_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="wednesday">{{ __('Wednesday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="thursday"
                                            name="selected_week_days[]" value="thursday">
                                        <label class="form-check-label" for="thursday"
                                         {{ in_array('thursday', old('selected_week_days', [])) ? 'checked' : '' }}>{{ __('Thursday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="friday"
                                            name="selected_week_days[]" value="friday"
                                             {{ in_array('friday', old('selected_week_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="friday">{{ __('Friday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="saturday"
                                            name="selected_week_days[]" value="saturday"
                                             {{ in_array('saturday', old('selected_week_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="saturday">{{ __('Saturday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sunday"
                                            name="selected_week_days[]" value="sunday"
                                             {{ in_array('sunday', old('selected_week_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sunday">{{ __('Sunday') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div id="periodicOptions" style="display: none;">
                                <div class="mb-3">
                                    <label for="number_of_days">{{ __('Number of Days to Perform') }}</label>
                                    <input type="number" class="form-control" id="number_of_days"
                                        name="number_of_days" value="{{ old('number_of_days') }}" min="1">
                                    @error('number_of_days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="number_of_rest_days">{{ __('Number of Rest Days') }}</label>
                                    <input type="number" class="form-control" id="number_of_rest_days"
                                        name="number_of_rest_days" value="{{ old('number_of_rest_days') }}"
                                        min="0">
                                    @error('number_of_rest_days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Create Objective') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Show the inputs depending on type of goal --}}
    <script>
        $(document).ready(function() {
            $("#objective_type").on("change", function() {
                var selectedType = $(this).val();
                $("#numberFields, #behavioralFields, #timeFields, #essentialFields").hide();

                if (selectedType === "number") {
                    $("#numberFields").show();
                } else if (selectedType === "behavioral") {
                    $("#behavioralFields").show();
                } else if (selectedType === "time") {
                    $("#timeFields").show();
                } else if (selectedType === "essential") {
                    $("#essentialFields").show();
                }
            });
        });
    </script>

    {{-- planning --}}
    <script>
        function showPlanningOptions(selectedValue) {
            const weeklyOptions = document.getElementById('weeklyOptions');
            const periodicOptions = document.getElementById('periodicOptions');

            if (selectedValue == 2) {
                weeklyOptions.style.display = 'block';
                periodicOptions.style.display = 'none';
            } else if (selectedValue == 3) {
                weeklyOptions.style.display = 'none';
                periodicOptions.style.display = 'block';
            } else {
                weeklyOptions.style.display = 'none';
                periodicOptions.style.display = 'none';
            }
        }
    </script>

    {{-- Importance --}}
    <script>
        const importanceInput = document.getElementById('importance');
        const importanceValue = document.getElementById('importanceValue');

        importanceInput.addEventListener('input', () => {
            const importanceLevel = importanceInput.value;
            importanceValue.textContent = getImportanceDescription(importanceLevel);
        });

        function getImportanceDescription(level) {
            switch (parseInt(level)) {
                case 1:
                    return 'Not Very Important';
                case 2:
                    return 'Not Important';
                case 3:
                    return 'Moderate';
                case 4:
                    return 'Important';
                case 5:
                    return 'Very Important';
                default:
                    return '';
            }
        }
    </script>



    {{-- Add estimated date to start date to give end date --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const startDateInput = document.getElementById("start_date");
            const estimatedDurationInput = document.getElementById("estimated_duration");
            const endDateInput = document.getElementById("end_date");

            function addMonths(date, months) {
                const newDate = new Date(date);
                newDate.setMonth(date.getMonth() + months);
                return newDate;
            }

            function addYears(date, years) {
                const newDate = new Date(date);
                newDate.setFullYear(date.getFullYear() + years);
                return newDate;
            }

            function updateEndDate() {
                const startDate = new Date(startDateInput.value);
                const estimatedDuration = estimatedDurationInput.value;

                if (startDate && estimatedDuration) {
                    let endDate;

                    switch (estimatedDuration) {
                        case "1_week":
                            endDate = new Date(startDate);
                            endDate.setDate(startDate.getDate() + 7);
                            break;
                        case "2_weeks":
                            endDate = new Date(startDate);
                            endDate.setDate(startDate.getDate() + 14);
                            break;
                        case "1_month":
                            endDate = addMonths(startDate, 1);
                            break;
                        case "2_months":
                            endDate = addMonths(startDate, 2);
                            break;
                        case "3_months":
                            endDate = addMonths(startDate, 3);
                            break;
                        case "6_months":
                            endDate = addMonths(startDate, 6);
                            break;
                        case "1_year":
                            endDate = addYears(startDate, 1);
                            break;
                    }

                    endDateInput.valueAsDate = endDate;
                }
            }

            startDateInput.addEventListener("change", updateEndDate);
            estimatedDurationInput.addEventListener("change", updateEndDate);
        });
    </script>

    {{-- make fields required depending on the type of objective --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the select element and input fields
            const objectiveTypeSelect = document.getElementById('objective_type');
            const planningIdSelect = document.getElementById('planning_type_id');

            const numberValueInput = document.getElementById('number_value');
            const initialTimeInput = document.getElementById('initial_time');
            const targetTimeInput = document.getElementById('target_time');
            // const behaviorOptionDoInput = document.getElementById('behavior_option_do');
            // const behaviorOptionDontInput = document.getElementById('behavior_option_dont');
            const numberOfDaysInput = document.getElementById('number_of_days');
            const numberOfRestDaysInput = document.getElementById('number_of_rest_days');
            const numberOfRestDaysInput = document.getElementById('behavioral');

            // Function to toggle the 'required' attribute on input fields
            function toggleRequiredAttributes() {
                const selectedObjectiveType = objectiveTypeSelect.value;
                const selectedPlanningType = planningTypeSelect.value;

                // Remove 'required' attribute from all fields
                [numberValueInput, initialTimeInput, targetTimeInput, numberOfDaysInput, numberOfRestDaysInput]
                .forEach(input => {
                    input.removeAttribute('required');
                });

                // Add 'required' attribute to the appropriate field(s)
                if (selectedObjectiveType === 'number') {
                    numberValueInput.setAttribute('required', 'required');
                } else  (selectedObjectiveType === 'time') {
                    initialTimeInput.setAttribute('required', 'required');
                    targetTimeInput.setAttribute('required', 'required');
                }
                //  else if (selectedObjectiveType === 'behavioral') {
                //     behaviorOptionDoInput.setAttribute('required', 'required');
                //     behaviorOptionDontInput.setAttribute('required', 'required');
                // }

                if (selectedPlanningType == 2) {
                    numberOfDaysInput.setAttribute('required', 'required');
                    numberOfRestDaysInput.setAttribute('required', 'required');

                } else if (selectedPlanningType == 3) {
                    numberOfDaysInput.setAttribute('required', 'required');
                    numberOfRestDaysInput.setAttribute('required', 'required');
                }
            }

            // Add an event listener to the select element to update 'required' attributes
            objectiveTypeSelect.addEventListener('change', toggleRequiredAttributes);

            // Initialize 'required' attributes based on the initial selected value
            toggleRequiredAttributes();
        });
    </script> --}}

    <x-footer />
</x-master>
