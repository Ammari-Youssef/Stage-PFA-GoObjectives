@props(['label', 'value', 'max', 'id', 'type' => 'show'])

<div class="percentage-bar" data-value="{{ $value }}">
    @if ($type === 'show')
        <div class="d-flex justify-content-between align-items-center">
            <span>{{ $label }}</span>
            @if ($value == 0)
                <span>Please rate this in progress page </span>
            @else
                <span>{{ $value }} / {{$max }}</span>
            @endif
        </div>
    @elseif($type === 'edit')
        <div class="row">
            <div class="col-6">{{ $label }}</div>
             @if ($value == 0)
                <span class="">Please rate this category </span>
          
            @endif
            <div class="col-6 text-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ 'editProgressModal' . $id }}" title="{{__('Edit')}}" data-id="{{$id}}" class="editIcon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#{{'progressDetailsModal'.$id}}" title="{{__('See details')}}"><i
                        class="fa-solid fa-eye"></i></a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#{{'deleteProgressModal'.$id}}" title="{{__('Initialize')}}"><i class="fas fa-undo"></i></a>
            </div>
        </div>
    @endif

    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" id="single-data-bar-{{ $id }}"
            role="progressbar" style="width: {{ ($value / $max) * 100 }}%;" aria-valuenow="{{ $value }}"
            aria-valuemin="0" aria-valuemax="{{ $max }}">{{ ($value / $max) * 100 }}%</div>
    </div>
</div>
