@extends('layouts.master')

@section('title')
    Pengaturan User
@endsection

@section('content')
    <div class="col-auto mt-2 mb-3">
        <a href="/user/index" class="btn btn-sm btn-light text-primary">kembali</a>
    </div>
    <div class="card">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-12 col-md-auto px-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        User Edit
                    </h6>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif
            <form action="{{ url('user/edit/user-' . $data->id) }}" method="POST">
                @csrf
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label class="small mb-1" for="first_name">First name</label>
                        <input class="form-control" id="first_name" name="first_name" type="text"
                            placeholder="Enter your first name" value="{{ $data->first_name }}" autocomplete="none">
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="last_name">Last name</label>
                        <input class="form-control" id="last_name" name="last_name" type="text"
                            placeholder="Enter your last name" value="{{ $data->last_name }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="nip">Username</label>
                    <input class="form-control" id="nip" name="nip" type="text"
                        placeholder="Enter your nip" value="{{ $data->nip }}">
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="email">Email address</label>
                    <input class="form-control" id="email" name="email" type="email"
                        placeholder="Enter your email address" value="{{ $data->email }}">
                </div>
                {{-- <div class="mb-3">
                    <label class="small mb-1" for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password"
                        placeholder="Enter your password" value="">
                </div> --}}
                <!-- Form Group (Roles)-->
                <div class="mb-3">
                    <label class="small mb-1">Role</label>
                    <select class="form-select" name="roles" id="roles" value="{{ $data->roles }}">
                        <option selected="" disabled="">Select a role:</option>
                        <option value="ADMIN"{{ $data->roles == 'ADMIN' ? 'selected' : '' }}>Admin</option>
                        <option value="REGISTERED"{{ $data->roles == 'REGISTERED' ? 'selected' : '' }}>Registered</option>
                        <option value="EDITOR"{{ $data->roles == 'EDITOR' ? 'selected' : '' }}>Editor</option>
                        <option value="GUEST"{{ $data->roles == 'GUEST' ? 'selected' : '' }}>Guest</option>
                    </select>
                </div>
                <!-- Submit button-->
                <div class="text-right">
                    <button class="btn btn-light btn-m text-primary" type="cancel">Cancel</button>
                    <button class="btn btn-primary btn-m" type="submit">Save Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
