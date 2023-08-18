@extends('layouts.auth') {{-- Assuming you have a layout file --}}
@section('title', 'Login')

@section('content')
<section class="vh-100 bg-light">
    <div class="container py-5 h-100">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body p-md-5">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-7 col-lg-6">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                            class="img-fluid" alt="Phone image">
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="text-center">
                            <h2 class="h1 fw-bold mb-4">{{__('Log in')}}</h2>
                        </div>
                        <form action="{{route('auth.login')}}" method="POST">
                            @csrf
                            @error('email_pwd')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                <input type="email" id="form1Example13" class="form-control form-control-lg"
                                    value="{{ old('email') }}" name="email" />
                                <label class="form-label" for="form1Example13">Email address</label>
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" />
                                <label class="form-label" for="form1Example23">Password</label>
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- Rememeber me --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3"
                                        checked />
                                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                                </div>
                                <a href="#!" class="text-muted">Forgot password?</a>
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                            <div class="divider d-flex align-items-center my-4">
                                <hr class="flex-grow-1">
                                <span class="mx-3 text-muted fw-bold">OR</span>
                                <hr class="flex-grow-1">
                            </div>
                            <div class="d-flex flex-column">
                                <a class="btn btn-primary btn-lg mb-3" style="background-color: #3b5998"
                                    href="#!" role="button">
                                    <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                                </a>
                                <a class="btn btn-primary btn-lg mb-3" style="background-color: #55acee" href="#!"
                                    role="button">
                                    <i class="fab fa-twitter me-2"></i>Continue with Twitter
                                </a>
                                <a class="btn btn-primary btn-lg mb-3" style="background-color: #dd4b39" href="#!"
                                    role="button">
                                    <i class="fab fa-google me-2"></i>Continue with Google
                                </a>
                                <button type="button" class="btn btn-primary btn-floating mx-1 mb-3">
                                    <i class="fab fa-linkedin-in"></i>
                                </button>
                            </div>
                        </form>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a
                                    href="{{ route('auth.signup') }}" class="link-danger">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
