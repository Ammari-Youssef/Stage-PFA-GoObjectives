 <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <a class="navbar-brand px-5" href="{{route('dashboard')}}">
            GoObjective
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 navbar-center">
                <!-- Navigation Links -->
                <li class="nav-item active">
                    <a class="nav-link p-lg-3" href="#">Welcome <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3" href="#aboutus">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3" href="#features">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3" href="#followus">Follow us</a>
                </li>
            </ul>

            <ul class=" nav navbar-nav ms-auto navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-language"></i> </a>
                    <div class="dropdown-menu " aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Arabic</a>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav ms-auto navbar-right">
                <li class="nav-item"><a class="p-3" href="{{route('auth.signup')}}"><i class="fas fa-user"></i> Sign Up</a></li>
                <li class="nav-item"><a class="p-3" href="{{route('auth.login')}}"><i class="fas fa-sign-in-alt"></i> Login</a></li>

            </ul>
            



        </div>
    </nav>