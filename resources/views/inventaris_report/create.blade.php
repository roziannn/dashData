@extends('layouts.master')
@section('title')
    Data Inventaris - Semua Data
@endsection

@section('content')
    <h4>Create New Report</h4>
    <div class="col-auto mt-2 mb-3">
        <a href="/inventaris/report/" class="btn btn-sm btn-light text-primary">Back</a>
    </div>
    <div class="card">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-12 col-md-auto px-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Report Details
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
            <form action="/inventaris/report/store" method="post">
                @csrf
                <div class="row gx-3 mb-4">
                    <div class="col-md-6">
                        <label class="small mb-1" for="report_token">Token</label>
                        <input class="form-control" id="report_token" name="report_token" type="text"
                            value="<?php echo $token; ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="author">Author Name</label>
                        <input class="form-control" id="author" name="author" type="text"
                            value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-default">Reported by</h6>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1" for="reporter_name">Name</label>
                        <input class="form-control" id="reporter_name" name="reporter_name" type="text"
                            placeholder="Enter reporter name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1" for="department">Department/Division</label>
                        <input class="form-control" id="department" name="department" type="text"
                            placeholder="Enter department" required>
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="details_problem">Details Problem</label>
                        <textarea id="details_problem" name="details_problem" class="form-control input-sm required" placeholder="Description"
                            rows="4"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="reporter_contact">Contact</label>
                        <input class="form-control" id="reporter_contact" name="reporter_contact" type="text"
                            placeholder="Enter reporter contact" required>
                    </div>
                </div>
                <!-- Submit button-->
                <div class="text-right">
                    <button class="btn btn-light btn-sm text-primary" type="cancel">Cancel</button>
                    <button class="btn btn-primary btn-sm" type="submit">Save Report</button>
                </div>
            </form>
        </div>
    </div>
@endsection
