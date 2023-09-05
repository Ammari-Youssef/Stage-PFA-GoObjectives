@props(['label', 'value', 'max', 'id', 'type' => 'show'])


<div class="percentage-bar" data-value="{{ $value }}">
    @if ($type === 'show')
        <div class="d-flex justify-content-between align-items-center">
            <span>{{ $label }}</span>
            <span></span>
            <span>{{ ($value / $max) * 100 }}%</span>
        </div>
    @elseif($type === 'edit')
        <div class="row">
            <div class="col-6">{{ $label }}</div>
            {{-- <div class="col-4 text-end">{{ ($value / $max) * 100 }}%</div>  --}}
            <div class=" text-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ 'editProgressModal' . $id }}" data-id="{{$id}}" class="editIcon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#{{'progressDetailsModal'.$id}}"><i
                        class="fa-solid fa-eye"></i></a>

            </div>
        </div>
    @endif

    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" id="single-data-bar-{{ $id }}"
            role="progressbar" style="width: {{ ($value / $max) * 100 }}%;" aria-valuenow="{{ $value }}"
            aria-valuemin="0" aria-valuemax="{{ $max }}">{{ ($value / $max) * 100 }}%</div>
    </div>
</div>






