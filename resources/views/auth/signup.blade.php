@extends('layouts.auth')
@section('title', __('Sign Up'))

@section('content')
    
<section class="vh-100 bg-light">
    <div class="container py-5 h-100">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body p-md-5">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                        <div class="text-center">
                            <h2 class="h1 fw-bold mb-5">{{ __('Sign up') }}</h2>
                        </div>
                        <form class="mx-1 mx-md-4" action="{{ route('auth.signup') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label" for="firstName">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    {{ __('First Name') }}
                                </label>
                                <input type="text" id="firstName" name="firstname"
                                    class="form-control @error('firstname') is-invalid @enderror"
                                    value="{{ old('firstname') }}" autofocus />

                                @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="lastName">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    {{ __('Last Name') }}
                                </label>
                                <input type="text" id="lastName" name="lastname"
                                    class="form-control @error('lastname') is-invalid @enderror"
                                    value="{{ old('lastname') }}" />

                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="username">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    {{ __('Username') }}
                                </label>
                                <input type="text" id="username" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}" />

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="email">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    {{ __('Your Email') }}
                                </label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" />

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="password">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    {{ __('Password') }}
                                </label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" />

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="passwordConfirmation">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    {{ __('Repeat your password') }}
                                </label>
                                <input type="password" id="passwordConfirmation" name="password_confirmation" class="form-control" />
                            </div>

                            <div class="form-check d-flex justify-content-center mb-5">
                                <label class="form-check-label" for="alreadyHaveAccount">
                                    {{ __('Already have an account?') }} <a href="{{ route('auth.login') }}" class="link-danger">{{ __('Sign in!') }}</a>
                                </label>
                            </div>

                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <button type="submit" class="btn btn-primary btn-lg">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                            class="img-fluid" alt="Sample image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
