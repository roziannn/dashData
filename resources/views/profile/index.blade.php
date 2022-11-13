@extends('layouts.master')




@section('title')
    My Profile
@endsection


@section('content')
    <div class="row">


        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="assets/img/illustrations/profiles/profile-1.png"
                        alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <form method="POST" action="{{ route('profile.update') }}">
                    @method('patch')
                    @csrf
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                            </div>
                        @endif
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="first_name">First name</label>
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                    placeholder="Enter your first name" value="{{ old('first_name', $user->first_name) }}">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="last_name">Last name</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                    placeholder="Enter your last name" value="{{ old('last_name', $user->last_name) }}">
                            </div>
                        </div>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="username">Username (how your name will appear to other users on
                                the site)</label>
                            <input class="form-control @error('username') is-invalid @enderror" id="username"
                                name="username" type="text" placeholder="Enter your username"
                                value="{{ old('username', $user->username) }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>username has already taken!</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Email address</label>
                            <input class="form-control" id="email" name="email" type="email"
                                placeholder="Enter your email address" value="{{ old('email', $user->email) }}">
                        </div>
                        {{-- <div class="mb-3">
                            <label class="small mb-1" for="email">Email address</label>
                            <input class="form-control" id="email" type="email" placeholder="Enter your email address"
                                value="{{ old('email', $user->email) }}">
                        </div> --}}
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
