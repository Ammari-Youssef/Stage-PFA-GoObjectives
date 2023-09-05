<x-master title="{{ __('Edit Progress') }}">
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
        <div class="container">

            <h2>Edit Your Progress</h2>

            <form action="{{ route('progress.update', $userId) }}" method="POST">
                @csrf
                @method('PUT') {{-- Use the PUT method to update progress --}}
                @foreach ($UserProgressData as $progress)
                    <div class="mb-3">
                        <label for="{{ $progress->category_id }}">{{ $progress->category->name }}</label>
                        <div class="text-center">
                            <span id="{{ $progress->category_id }}Value">{{ $progress->rating }}</span>
                        </div>
                        <input type="range" class="form-range" min="0" max="10" step="0.25"
                            id="{{ $progress->category_id }}" name="progress[{{ $progress->category_id }}]"
                            value="{{ $progress->rating }}" step="0.25" required>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">{{ __('Update Progress') }}</button>
            </form>


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
