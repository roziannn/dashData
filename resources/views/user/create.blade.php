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
                        User Details
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
            <form action="/user/store" method="post">
                @csrf
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label class="small mb-1" for="first_name">First name</label>
                        <input class="form-control" id="first_name" name="first_name" type="text"
                            placeholder="Enter your first name" required autocomplete="none">
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="last_name">Last name</label>
                        <input class="form-control" id="last_name" name="last_name" type="text"
                            placeholder="Enter your last name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="nip">NIP</label>
                    <input class="form-control" id="nip" name="nip" type="text"
                        placeholder="Enter your nip" required>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="email">Email address</label>
                    <input class="form-control" id="email" name="email" type="email"
                        placeholder="Enter your email address" required>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password"
                        placeholder="Enter your password" required>
                </div>
                <!-- Form Group (Group Selection Checkboxes)-->
                {{-- <div class="mb-3">
                    <label class="small mb-1">Group(s)</label>
                    <div class="form-check">
                        <input class="form-check-input" id="groupSales" type="checkbox" value="">
                        <label class="form-check-label" for="groupSales">Sales</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="groupDevs" type="checkbox" value="">
                        <label class="form-check-label" for="groupDevs">Developers</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="groupMarketing" type="checkbox" value="">
                        <label class="form-check-label" for="groupMarketing">Marketing</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="groupManagers" type="checkbox" value="">
                        <label class="form-check-label" for="groupManagers">Managers</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="groupCustomer" type="checkbox" value="">
                        <label class="form-check-label" for="groupCustomer">Customer</label>
                    </div>
                </div> --}}
                <!-- Form Group (Roles)-->
                <div class="mb-3">
                    <label class="small mb-1">Role</label>
                    <select class="form-select" name="roles" id="roles" required>
                        <option selected="" disabled="">Select a role:</option>
                        <option value="ADMIN">Admin</option>
                        <option value="Empolyee">Empolyee</option>
                        <option value="GUEST">Guest</option>
                    </select>
                </div>
                <!-- Submit button-->
                <div class="text-right">
                    <button class="btn btn-light btn-m text-primary" type="cancel">Cancel</button>
                    <button class="btn btn-primary btn-m" type="submit">Add new user</button>
                </div>
            </form>
        </div>
    </div>
@endsection
