@props(['progress'])
<div class="modal fade" id="{{'progressDetailsModal' .$progress->id}}" tabindex="-1" aria-labelledby="progressDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="progressDetailsModalLabel">Progress Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Include your show view content here --}}
                <h5 class="card-title">Category: {{ $progress->category->name }}</h5>
                <p class="card-text">Rating: {{ $progress->rating }}</p>
                <p class="card-text">User : {{ $progress->user->username }}</p>
                <p class="card-text">Created At: {{ $progress->created_at->format('F j, Y H:i:s') }}</p>
                <p class="card-text">Updated At: {{ $progress->updated_at->format('F j, Y H:i:s') }}</p>
                <x-charts.single-data-percentage-bar label="{!! $progress->category->name !!}"
                                        value="{{ $progress->rating }}" max="10" id="{{ $progress->id }}"
                                        type="show" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{route('progress.show',$progress->id)}}"  class="btn btn-primary" >{{__('View more ')}}</a>
            </div>
        </div>
    </div>
</div>
