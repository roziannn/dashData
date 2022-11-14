@extends('layouts.master')
@section('title')
    My Profile
@endsection

@section('content')
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">Change Password</div>
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                @endif
                <form method="POST" action="{{ route('password.update') }}">
                    @method('patch')
                    @csrf
                    <!-- Form Group (current password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="current_password">Current Password</label>
                        <input class="form-control @error('current_password') is-invalid @enderror" id="current_password"
                            type="password" placeholder="Enter current password" name="current_password" required
                            autocomplete="current_password" autofocus>
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Form Group (new password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="password">New Password</label>
                        <input class="form-control" id="password" name="password" type="password"
                            placeholder="Enter new password" autocomplete="new-password">
                    </div>
                    <!-- Form Group (confirm password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="password-confirm">Confirm Password</label>
                        <input class="form-control" id="password-confirm" name="password_confirmation" type="password"
                            placeholder="Confirm new password" autocomplete="new-password">
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
