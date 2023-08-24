<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">{{ __('GoObjective') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item justify-content-center">
                    <a class="nav-link{{ request()->is('/') ? ' active' : '' }}" href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('task-list') ? ' active' : '' }}"
                        href="/task-list">{{ __('Task List') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('objectives') ? ' active' : '' }}"
                        href="/objectives">{{ __('Objectives') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('progress') ? ' active' : '' }}"
                        href="/progress">{{ __('Progress') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ \Illuminate\Support\facades\Auth::user()->username }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{route('profile.show')}}">{{ __('My Profile') }}</a></li>
                       
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('auth.logout') }}">{{ __('Logout') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Language') }} <i class="fas fa-language"></i> </a>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <span class="fi fi-gb"></span>
                                {{ __('English') }}

                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <span class="fi fi-ma"></span>
                                {{ __('Arabic') }}

                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            </li>
            </ul>
        </div>






    </div>
</nav>
