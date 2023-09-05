<x-master title="{{ __('Progress') }}">
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
        <div class="row">
           
                        <h2>{{__('Rate Your Progress')}}</h2>
                        <form action="{{ route('progress.store') }}" method="POST">
                            @csrf
                            @foreach ($categories as $category)
                                <div class="mb-3">
                                    <label for="{{ $category->id }}">{{ $category->name }}</label>
                                    <div class="text-center">
                                        <span id="{{ $category->id }}Value">5.0</span>
                                    </div>
                                    <input type="range" class="form-range" min="0" max="10"
                                        step="0.25" id="{{ $category->id }}"
                                        name="category {{$category->id}}" step="0.25"  required>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add this script to update the value display as the user slides the range input
        const rangeInputs = document.querySelectorAll('.form-range');

        rangeInputs.forEach(input => {
            const displayElement = document.getElementById(`${input.id}Value`);
            input.addEventListener('input', () => {
                displayElement.textContent = input.value;
            });
        });
    </script>

    <x-footer />
</x-master>
