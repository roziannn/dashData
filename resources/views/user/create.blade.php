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
            <form>
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (first name)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputFirstName">First name</label>
                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name"
                            value="">
                    </div>
                    <!-- Form Group (last name)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputLastName">Last name</label>
                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name"
                            value="">
                    </div>
                </div>
                <!-- Form Group (email address)-->
                <div class="mb-3">
                    <label class="small mb-1" for="inputEmailAddress">Username</label>
                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your username"
                        value="">
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address"
                        value="">
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="inputEmailAddress">Password</label>
                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your password"
                        value="">
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
                {{-- <div class="mb-3">
                <label class="small mb-1">Role</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected="" disabled="">Select a role:</option>
                    <option value="administrator">Administrator</option>
                    <option value="registered">Registered</option>
                    <option value="edtior">Editor</option>
                    <option value="guest">Guest</option>
                </select>
            </div> --}}
                <!-- Submit button-->
                <div class="text-right">
                    <button class="btn btn-light btn-m text-primary" type="cancel">Cancel</button>
                    <button class="btn btn-primary btn-m" type="button">Add new user</button>
                </div>
            </form>
        </div>
    </div>
@endsection
