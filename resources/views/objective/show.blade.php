<x-master title="{{__('My objectives')}}">

    <x-navbar/>
   <div class="container">
        <h1>Objective Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $objective->ObjectiveTitle }}</h5>
                <p class="card-text"><strong>{{ __('Description') }}:</strong> {{ $objective->Description }}</p>
                <p class="card-text"><strong>{{ __('Category') }}:</strong> {{ $objective->Category }}</p>

                <hr>

                <h5 class="card-title">{{ __('Additional Details') }}</h5>
                <p class="card-text"><strong>{{ __('Motive') }}:</strong> {{ $objective->Motive }}</p>
                <p class="card-text"><strong>{{ __('Level') }}:</strong> {{ $objective->Level }}</p>
                <p class="card-text"><strong>{{ __('Subobjectives') }}:</strong></p>
                <ul>
                    
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                    
                </ul>
                <button class="btn btn-primary" id="addSubobjective">{{ __('Add Subobjective') }}</button>
                <p class="card-text"><strong>{{ __('Tasks') }}:</strong></p>
                <ul>
                    {{-- @foreach ($objective->tasks as $task)
                        <li>{{ $task->name }}</li>
                    @endforeach --}}
                    <li>task 1</li>
                    <li>task 1</li>
                    <li>task 1</li>
                </ul>
                <button class="btn btn-primary" id="addTask">{{ __('Add Task') }}</button>

                <a href="{{ route('objective.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
            </div>
        </div>
    </div>

<x-footer/>
</x-master>