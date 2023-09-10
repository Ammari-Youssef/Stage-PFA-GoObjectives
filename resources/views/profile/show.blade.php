<x-master title="{{ __('My Profile') }}">

    <x-navbar />

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Profile Information') }}</div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <p class="text-black-50 card-text">Update your information and email address </p>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">{{ __('First Name') }}</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    value="{{ old('firstname', $user->firstname) }}">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    value="{{ old('lastname', $user->lastname) }}">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username', $user->username) }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Save Profile') }}</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">

                    <div class="card-header">{{ __('Update Password') }}</div>
                    <div class="card-body">
                        <p class="card-text text-black-50">Ensure your account is using a long, random password to stay
                            secure.</p>
                        <p class="card-text text-black-50">Update your information and email address .</p>
                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="old_password" class="form-label">{{ __('Old Password') }}</label>
                                <input type="password" class="form-control" id="old_password" name="old_password">
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">{{ __('New Password') }}</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation"
                                    class="form-label">{{ __('Confirm New Password') }}</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Delete Account') }}</div>
                    <div class="card-body">
                        <p class="text-black-50 cartd-text">Permanently delete your account and all associated data</p>
                        <p class="card-text text-black-50">Once account deleted, your data will be destroyed</p>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Confirm Account Deletion') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete your account? This action cannot be undone.') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('Cancel') }}</button>
                    <form action="{{ route('profile.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master>
