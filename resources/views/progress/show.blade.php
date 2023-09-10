<x-master title="Progress Details">
    <x-navbar />

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Progress Details
            </div>
            <div class="card-body">
                <h5 class="card-title">Category: {{ $progress->category->name }}</h5>
                <p class="card-text">Rating: {{ $progress->rating }}</p>
                <p class="card-text">User: {{ $progress->user->username }}</p>
                <p class="card-text">Created At: {{ $progress->created_at->format('F j, Y H:i:s') }}</p>
                <p class="card-text">Updated At (lately): {{ $progress->updated_at->format('F j, Y H:i:s') }}</p>

                <x-charts.single-data-percentage-bar label="{!! $progress->category->name !!}" value="{{ $progress->rating }}"
                    max="10" id="{{ $progress->id }}" type="show" />

                <div class="alert alert-info mt-3" role="alert">
                    <h5 class="alert-heading">User Insights:</h5>
                    <ul class="list-unstyled mb-0">
                       
                        <li>{!! $insights !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-master>
