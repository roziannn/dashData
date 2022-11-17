@extends('layouts.master')
@section('title')
    Data Inventaris - Semua Data
@endsection

@section('content')
    <div class="row">
        <div class="col-auto mr-auto">
            <h4>Item Report</h4>
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
    <div class="row mb-3 mt-2">
        <div class="col-auto mr-auto">
            <a href="/inventaris/report" class="btn-sm btn-light text-primary"> back</a>
        </div>
        <div class="col-auto">
            <a href="#" style="text-decoration: none" class="btn-sm btn-warning" data-toggle="modal"
                data-target="#modal-primary"> Add Solution</a>
        </div>
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
            {{-- <form action="{{ url('/inventaris/report/update' . $data->id) }}" method="post"> --}}
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
                        value="{{ old('reporter_name', $data->reporter_name) }}">
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
            {{-- </form> --}}
        </div>
        {{-- primary modal // ADD SOLUTION --}}
        <div class="modal fade" id="modal-primary">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give a solution</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/inventaris/report/solution-update' . $data->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1 mr-5" for="status">Status</label>
                                    <select class="form-control input-sm" name="status" id="status">
                                        <option value="Self Service">Self Service</option>
                                        <option value="Vendor">Vendor</option>
                                    </select>

                                    {{-- script other value --}}
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                    <script type="text/javascript">
                                        var otherInput;
                                        var startService, endService;
                                        var serviceTypeInput = $('#status');
                                        serviceTypeInput.on('change', function() {
                                            otherInput = $('#vendor_name');
                                            startService = $('#start_service');
                                            endService = $('#end_service');
                                            if (serviceTypeInput.val() == "Vendor") {
                                                otherInput.show();
                                                startService.show();
                                                endService.show();
                                            } else {
                                                otherInput.hide();
                                                startService.hide();
                                                endService.hide();
                                            }
                                        });
                                    </script>
                                </div>
                                {{-- other field --}}
                                <div class="col-sm-4 mb-3">
                                    {{-- <label class="small mb-1 mr-5" for="vendor">Vendor Name</label> --}}
                                    <input class="form-control form-control-user" name='vendor_name' id='vendor_name'
                                        type="text" placeholder="Vendor Name" title="Vendor Name"
                                        style="display: none">
                                </div>
                                <div class="col-sm-4">
                                    {{-- tanggal --}}
                                    {{-- <label class="small mb-1 mr-5" for="start_service">Start Date</label> --}}
                                    <input type="date" class="form-control" id="start_service" name="start_service"
                                        title="Start service date" style="display: none">
                                </div>
                                <div class="col-sm-4">
                                    {{-- <label class="small mb-1 mr-5" for="end_service">End Date</label> --}}
                                    <input type="date" class="form-control" id="end_service" name="end_service"
                                        title="End service date" style="display: none">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1" for="solution">Solution</label>
                                    <textarea id="solution" name="solution" class="form-control input-sm required" placeholder="Description"
                                        value="" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-sm pull-left"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection