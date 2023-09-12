<x-master title="{{ __('Objective details') }}">
    <x-navbar />
    <div class="container">
        <h1>{{ __('Objective Details') }}</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $objective->title }}</h5>
                <p class="card-text"><strong>{{ __('Description') }}:</strong>
                    @if ($objective->description)
                        {{ $objective->description }}
                    @else
                        {{ __('No description available') }}
                    @endif
                </p>
                <p class="card-text"><strong>{{ __('Category') }}:</strong> {{ $objective->category->name }}</p>

                <p class="card-text"><strong>{{ __('Current Goal') }}:</strong>
                    @if ($objective->type === 'number')
                        {{ $objective->number_value }}
                    @elseif ($objective->type === 'time')
                        {{ $formattedTime }}
                    @elseif ($objective->type === 'behavioral')
                        {{ $objective->behavior_option ? __('Do ') . $objective->title : __('Do Not Do ') . $objective->title }}
                    @else
                        {{ __('No current goal available') }}
                    @endif
                </p>
                <hr>

                <h5 class="card-title">{{ __('Additional Details') }}</h5>
                <p class="card-text"><strong>{{ __('Motives') }}:</strong>
                    @if ($objective->motive->count() > 0)
                        {{ $objective->motive->count() }}
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('No motives available') }} <a
                                href="{{ route('motive.create') }}">{{ __('Add a motive') }}</a>
                        </div>
                    @endif
                </p>

                <p class="card-text"><strong>{{ __('Level') }}:</strong>
                    @if ($objective->level)
                        {{ $objective->level }}
                    @else
                        {{ __('No level available') }}
                    @endif
                </p>

                @if ($objective->type === 'essential')
                    <p class="card-text"><strong>{{ __('Subobjectives') }}:</strong></p>
                    @if ($objective->subobjectives->count() > 0)
                        <ul>
                            @foreach ($objective->subobjectives as $subobjective)
                                <li>
                                    {{ $subobjective->title }}

                                    <a href="{{ route('objective.show', ['objective' => $subobjective->id]) }}"
                                        class="btn ">
                                        <i class="fas fa-eye"></i></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('No subobjectives available') }}
                        </div>
                    @endif
                    <a href="{{ route('objective.create', ['objective_parent_id' => $objective->id]) }}"
                        class="btn btn-primary">
                        {{ __('Add Subobjective') }}
                    </a>
                @endif


                <p class="card-text"><strong>{{ __('Tasks') }}:</strong></p>
                @if ($objective->tasks->count() > 0)
                    <ul>
                        @foreach ($objective->tasks as $task)
                            <li>{{ $task->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-info" role="alert">
                        {{ __('No tasks available') }}
                    </div>
                @endif
                <button class="btn btn-primary" id="addTask">{{ __('Add Task') }}</button>



                <p class="card-text"><strong>{{ __('Result') }}:</strong>
                    @if ($objective->result)
                        {{ $objective->result }}
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('No result available') }}
                        </div>
                        <a href="{{ route('task.create') }}"  class="btn btn-primary">{{ __('Add result') }}</a>
                    @endif
                </p>

            </div>
        </div>
    </div>

    <x-footer />
</x-master>
