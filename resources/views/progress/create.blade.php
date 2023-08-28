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
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Rate Your Progress</div>
                    <div class="card-body">
                        <form action="{{ route('progress.store') }}" method="POST">
                            @csrf
                            @foreach ($categories as $category)
                                <div class="mb-3">
                                    <label for="{{ $category }}">{{ $category }}</label>
                                    <div class="text-center">
                                        <span id="{{ $category }}Value">0</span>
                                    </div>
                                    <input type="range" class="form-range" min="0" max="10"
                                        step="0.1" id="{{ $category }}"
                                        name="{{ strtolower(str_replace(' & ', '_', $category)) }}" required>
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
