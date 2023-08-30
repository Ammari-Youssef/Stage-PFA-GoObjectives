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
                    <a class="nav-link{{ request()->is('/') ? ' active' : '' }}"
                        href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('task') ? ' active' : '' }}"
                        href="{{ route('task.index') }}">{{ __('Task List') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('objective') ? ' active' : '' }}"
                        href="{{ route('objective.index') }}">{{ __('Objectives') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('progress') ? ' active' : '' }}"
                        href="{{ route('progress.index') }}">{{ __('Progress') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (\Illuminate\Support\Facades\Auth::check())
                            {{ \Illuminate\Support\Facades\Auth::user()->username }}
                        @else
                            <a href="{{ route('login') }}">Login</a>
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('My Profile') }}</a>
                        </li>

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
