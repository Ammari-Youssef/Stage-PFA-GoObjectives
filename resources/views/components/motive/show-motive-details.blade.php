@props(['motive'])
<div class="modal fade" id="motiveDetailsModal{{$motive->id}}" tabindex="-1" aria-labelledby="motiveDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="motiveDetailsModalLabel">{{__('Motive Details')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your motive details here -->
                <h5 class="card-title">{{ $motive->title }}</h5>
                <p class="card-text"><strong>{{ __('Motive Type') }}:</strong> {{ Str::ucfirst($motive->type) }}</p>
                <p class="card-text"><strong>{{ __('Motive Description') }}:</strong> {{ $motive->description }}</p>
                <p class="card-text"><strong>{{ __('Created at') }}:</strong> {{ $motive->created_at }}</p>
                <p class="card-text"><strong>{{ __('Last updated') }}:</strong> {{ $motive->updated_at }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{route('motive.show',$motive->id)}}"  class="btn btn-primary" >{{__('View more ')}}</a>
            </div>
        </div>
    </div>
</div>
