@extends('layouts.master')
@section('title')
    Data Inventaris - Semua Data
@endsection

@section('content')
    <div class="row">
        <div class="col-auto mr-auto">
            <h4>Edit Item</h4>
        </div>
        <div class="col-auto">
            <small>{{ $data->report_token }} / {{ $data->report_date }} / {{ $data->author }}</small>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    @endif
    <div class="row col-auto mt-2 mb-3">
        <a href="/inventaris/report" class="btn btn-sm btn-light text-primary"> back</a>
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
            <form action="{{ url('/inventaris/report/update' . $data->id) }}" method="post">
                @csrf
                <div class="row gx-3 mb-4">
                    <div class="col-md-6">
                        <label class="small mb-1" for="report_token">Token</label>
                        <input class="form-control" id="report_token" name="report_token" type="text"
                            value="{{ $data->report_token }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="author">Author Name</label>
                        <input class="form-control" id="author" name="author" type="text" value="{{ $data->author }}"
                            readonly>
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
                            value="{{ $data->reporter_name }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1" for="department">Department/Division</label>
                        <input class="form-control" id="department" name="department" type="text"
                            value="{{ $data->department }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1" for="details_problem">Details Problem</label>
                        <textarea id="details_problem" name="details_problem" class="form-control input-sm required" placeholder="Description"
                            rows="4">{{ $data->details_problem }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1" for="reporter_contact">Contact</label>
                        <input class="form-control" id="reporter_contact" name="reporter_contact" type="text"
                            value={{ $data->reporter_contact }}>
                        <label class="small mb-1" for="report_date">Report Date</label>
                        <input class="form-control" id="report_date" name="report_date" type="text"
                            value="{{ $data->report_date }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-default">Completed by</h6>
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
