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
                            {{-- Title --}}
                            <div class="mb-3">
                                <label for="objectiveTitle">{{ __('Objective Title') }}</label>
                                <input type="text" class="form-control" id="objectiveTitle" name="ObjectiveTitle"
                                    value="{{ old('ObjectiveTitle') }}" required>
                                @error('ObjectiveTitle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Desscription --}}
                            <div class="mb-3">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" name="Description" rows="4">{{ old('Description') }}</textarea>
                                @error('Description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Category --}}
                            <div class="mb-3">
                                <label for="category">{{ __('Category') }}</label>
                                <select class="form-select" id="category" name="Category" required>
                                    <option value="" disabled selected>{{ __('Select a category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}"
                                            {{ old('Category') === $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Desired Result --}}
                            <div class="mb-3">
                                <label>{{ __('Desired Result') }}</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ExpectedResult"
                                            id="improve" value="1"
                                            {{ old('ExpectedResult') === '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="improve">{{ __('Improve') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ExpectedResult"
                                            id="remove" value="0"
                                            {{ old('ExpectedResult') === '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remove">{{ __('Remove') }}</label>
                                    </div>
                                </div>
                                @error('ExpectedResult')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Type goal --}}
                            <div class="mb-3">
                                <label for="objective_type">{{ __('Type of Objective') }}</label>
                                <select class="form-select" id="objective_type" name="Type" required>
                                    <option value="" disabled selected>Choose Nature of Objective</option>
                                    <option value="number" {{ old('Type') === 'number' ? 'selected' : '' }}>Number
                                    </option>
                                    <option value="time" {{ old('Type') === 'time' ? 'selected' : '' }}>Time</option>
                                    <option value="logic" {{ old('Type') === 'logic' ? 'selected' : '' }}>Logic
                                    </option>
                                    <option value="essential" {{ old('Type') === 'essential' ? 'selected' : '' }}>
                                        Essential</option>
                                </select>
                                @error('Type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div id="numberFields" style="display: none;">
                                    <label for="number_value">{{ __('Number Value') }}</label>
                                    <input type="number" class="form-control" id="number_value" name="NumberValue"
                                        value="{{ old('NumberValue') }}" min="0" required>
                                    @error('NumberValue')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="logicFields" style="display: none;">
                                    <label>{{ __('Choose an option') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="LogicOption"
                                            id="logic_option_do" value="do">
                                        <label class="form-check-label" for="logic_option_do">
                                            Do It
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="LogicOption"
                                            id="logic_option_dont" value="dont">
                                        <label class="form-check-label" for="logic_option_dont">
                                            Don't Do It
                                        </label>
                                    </div>
                                    @error('LogicOption')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="timeFields" style="display: none;">
                                    <label for="initial_duration">{{ __('Initial Duration (minutes)') }}</label>
                                    <input type="number" class="form-control" id="initial_duration"
                                        name="InitialDuration" value="{{ old('InitialDuration') }}" required>
                                    @error('InitialDuration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <label for="target_duration">{{ __('Target Duration (minutes)') }}</label>
                                    <input type="number" class="form-control" id="target_duration"
                                        name="TargetDuration" value="{{ old('TargetDuration') }}" required>
                                    @error('TargetDuration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="essentialFields" style="display: none;">
                                    <p class="alert alert-info">
                                        {{ __('You can create subobjectives for this goal later.') }}</p>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="importance">{{ __('Importance') }}</label>
                                <input type="range" class="form-range" min="1" max="5"
                                    id="importance" name="Importance" value="{{ old('Importance') }}" required>
                                <div class="text-center">
                                    <span id="importanceValue">{{ old('Importance') ?: 'Choose imprtance' }}</span>
                                </div>
                                @error('Importance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Repeat for other input fields -->

                           
                            {{-- Start date --}}
                            <div class="mb-3">
                                <label for="startDate">{{ __('Start Date') }}</label>
                                <input type="date" class="form-control" id="startDate" name="DateStart"
                                    value="{{ old('DateStart') }}" required>
                                @error('DateStart')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Duree Estimee --}}
                            <div class="mb-3">
                                <label for="dureeEstimee">{{ __('Estimated Duration') }}</label>
                                <select class="form-select" id="dureeEstimee" name="DureeEstimee" required>
                                    <option value="1_week">{{ __('1 week') }}</option>
                                    <option value="2_weeks">{{ __('2 weeks') }}</option>
                                    <option value="1_month">{{ __('1 month') }}</option>
                                    <option value="2_months">{{ __('2 months') }}</option>
                                    <option value="3_months">{{ __('3 months') }}</option>
                                    <option value="6_months">{{ __('6 months') }}</option>
                                    <option value="1_year">{{ __('1 year') }}</option>
                                </select>
                                @error('duree_estimee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            

                            {{-- End date --}}
                            <div class="mb-3">
                                <label for="endDate">{{ __('End Date') }}</label>
                                <input type="date" class="form-control" id="endDate" name="DateDeadline"
                                    value="{{ old('DateDeadline') }}" required>
                                @error('DateDeadline')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                             {{-- planning --}}
                            <div class="mb-3">
                                <label for="planning">{{ __('Planning') }}</label>
                                <select class="form-select" id="planning" name="Planning"
                                    onchange="showPlanningOptions(this.value)" required>
                                    <option value="" disabled selected>{{ __('Select Planning Type') }}</option>
                                    <option value="daily">{{ __('Daily') }}</option>
                                    <option value="weekly">{{ __('Weekly') }}</option>
                                    <option value="periodic">{{ __('Periodic') }}</option>
                                </select>
                                @error('Planning')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
{{-- weekly planning --}}
                            <div id="weeklyOptions" style="display: none;">
                                <div class="mb-3">
                                    <label for="weeklyDays">{{ __('Select Weekly Days') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="monday"
                                            name="weekly_days[]" value="monday">
                                        <label class="form-check-label" for="monday">{{ __('Monday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tuesday"
                                            name="weekly_days[]" value="tuesday">
                                        <label class="form-check-label" for="tuesday">{{ __('Tuesday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wednesday"
                                            name="weekly_days[]" value="wednesday">
                                        <label class="form-check-label" for="wednesday">{{ __('Wednesday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="thursday"
                                            name="weekly_days[]" value="thursday">
                                        <label class="form-check-label" for="thursday">{{ __('Thursday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="friday"
                                            name="weekly_days[]" value="friday">
                                        <label class="form-check-label" for="friday">{{ __('Friday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="saturday"
                                            name="weekly_days[]" value="saturday">
                                        <label class="form-check-label" for="saturday">{{ __('Saturday') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sunday"
                                            name="weekly_days[]" value="sunday">
                                        <label class="form-check-label" for="sunday">{{ __('Sunday') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div id="periodicOptions" style="display: none;">
                                <div class="mb-3">
                                    <label for="periodicDays">{{ __('Number of Days to Perform') }}</label>
                                    <input type="number" class="form-control" id="periodicDays"
                                        name="periodic_days" value="{{ old('periodic_days') }}" min="1"
                                        required>
                                    @error('periodic_days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="restDays">{{ __('Number of Rest Days') }}</label>
                                    <input type="number" class="form-control" id="restDays" name="RestDays"
                                        value="{{ old('RestDays') }}" min="0" required>
                                    @error('RestDays')
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
    {{-- Actions of type of goal --}}
    <script>
        $(document).ready(function() {
            $("#objective_type").on("change", function() {
                var selectedType = $(this).val();
                $("#numberFields, #logicFields, #timeFields, #essentialFields").hide();

                if (selectedType === "number") {
                    $("#numberFields").show();
                } else if (selectedType === "logic") {
                    $("#logicFields").show();
                } else if (selectedType === "time") {
                    $("#timeFields").show();
                } else if (selectedType === "essential") {
                    $("#essentialFields").show();
                }
            });
        });
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

    {{-- planning --}}
    <script>
        function showPlanningOptions(selectedValue) {
            const weeklyOptions = document.getElementById('weeklyOptions');
            const periodicOptions = document.getElementById('periodicOptions');

            if (selectedValue === 'weekly') {
                weeklyOptions.style.display = 'block';
                periodicOptions.style.display = 'none';
            } else if (selectedValue === 'periodic') {
                weeklyOptions.style.display = 'none';
                periodicOptions.style.display = 'block';
            } else {
                weeklyOptions.style.display = 'none';
                periodicOptions.style.display = 'none';
            }
        }
    </script>
    
    {{-- Add estimated date to start date to give end date --}}
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const startDateInput = document.getElementById("startDate");
        const estimatedDurationInput = document.getElementById("dureeEstimee");
        const endDateInput = document.getElementById("endDate");

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

    <x-footer />
</x-master>
