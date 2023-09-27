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
            <small>{{ $data->report_token }}/{{ $data->author }}</small>
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
            <a href="/inventaris/report" class="btn-sm btn-light text-primary text-decoration-none"> back</a>
        </div>
        @if ($data->solution == null)
            <div class="col-auto">
                <a href="#" style="text-decoration: none" class="btn-sm btn-warning" data-toggle="modal"
                    data-target="#modal-primary"> Add Solution</a>
            </div>
        @endif

    </div>
    <div class="card mb-3">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-12 col-md-auto px-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-align-left mr-2"></i>Report Details
                    </h6>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{-- <form action="{{ url('/inventaris/report/update' . $data->id) }}" method="post"> --}}
            @csrf
            <div class="row gx-3 mb-5">
                <div class="col-md-6">
                    <label class="small mb-1" for="report_token">Token</label>
                    <input class="form-control" id="report_token" name="report_token" type="text"
                        value="{{ $data->report_token }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="report_date">Report Date</label>
                    <input class="form-control" id="report_date" name="report_date" type="text"
                        value="{{ $data->report_date }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="author">Author Name</label>
                    <input class="form-control" id="author" name="author" type="text" value="{{ $data->author }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="inventarisCategory_name">Category</label>
                    <input class="form-control" id="inventarisCategory_name" name="inventarisCategory_name"
                        value="{{ $data->inventarisCategory_name }}" readonly>
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
                        value="{{ old('reporter_name', $data->reporter_name) }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="small mb-1" for="department">Department/Division</label>
                    <input class="form-control" id="department" name="department" type="text"
                        value="{{ $data->department }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="small mb-1" for="details_problem">Details Problem</label>
                    <textarea id="details_problem" name="details_problem" class="form-control input-sm required" placeholder="Description"
                        rows="4" readonly>{{ $data->details_problem }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="small mb-1" for="reporter_contact">Contact</label>
                    <input class="form-control" id="reporter_contact" name="reporter_contact" type="text"
                        value={{ $data->reporter_contact }} readonly>
                </div>
            </div>
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
                        <form action="{{ url('/inventaris/report/solution-add' . $data->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <input class="form-control form-control-user col-sm-4 mb-3" name='executor'
                                    id='executor' type="hidden"
                                    value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                <input class="form-control form-control-user col-sm-4 mb-3" name='status' id='status'
                                    type="hidden" value="1">
                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1 mr-5" for="service_type">Service Type</label>
                                    <select class="form-control input-sm" name="service_type" id="service_type">
                                        <option value="Self Service">Self Service</option>
                                        <option value="Vendor">Vendor</option>
                                    </select>

                                    {{-- script other value --}}
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                    <script type="text/javascript">
                                        var otherInput;
                                        var startService, endService;
                                        var serviceTypeInput = $('#service_type');
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
    {{-- SOLUTION --}}
    {{-- @include('inventaris_report.solution.another_solution') --}}
    @if ($data->solution == null)
    @else
        <div class="card mb-3">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-paperclip mr-2"></i>Solution</h6>
                    </div>
                    <small class="mr-3">by {{ $data->executor }} {{ $data->updated_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('inventaris/report/solution-update' . $data->id) }}" method="post">
                    @csrf
                    <div class="row gx-3 mb-2">
                        <div class="col-md-6">
                            <input class="form-control form-control-user col-sm-4 mb-3" name='executor' id='executor'
                                type="hidden" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                            <label class="small mb-1" for="service_type">Service Type</label>
                            <select class="form-control input-sm" name="service_type" id="updateservice_type"
                                @if ($data->executor !== $checkExecutor) disabled @endif>
                                <option value="Self Service"{{ $data->service_type == 'Self Service' ? 'selected' : '' }}>
                                    Self Service</option>
                                <option value="Vendor"{{ $data->service_type == 'Vendor' ? 'selected' : '' }}>Vendor
                                </option>
                            </select>

                            {{-- script other value --}}
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <script type="text/javascript">
                                var otherInput;
                                var startService, endService;
                                var serviceTypeInput = $('#updateservice_type');
                                serviceTypeInput.on('change', function() {
                                    otherInput = $('#updateVendor_name');
                                    startService = $('#updateStart_service');
                                    endService = $('#updateEnd_service');
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

                            {{-- other field --}}
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    {{-- <label class="small mb-1 mr-5" for="vendor" >Vendor Name</label> --}}
                                    <input class="form-control form-control-user" name='vendor_name'
                                        id='updateVendor_name' type="text" placeholder="Enter vendor name"
                                        value="{{ $data->vendor_name }}"
                                        @if ($data->service_type == 'Self Service') style="display: none" @elseif($data->executor !== $checkExecutor) disabled @endif>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    {{-- <label class="small mb-1 mr-5" for="start_service">Start Date</label> --}}
                                    <input type="date" class="form-control" id="updateStart_service"
                                        name="start_service" value="{{ $data->start_service }}"
                                        @if ($data->service_type == 'Self Service') style="display: none" @elseif($data->executor !== $checkExecutor) disabled @endif>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    {{-- <label class="small mb-1 mr-5" for="end_service">End Date</label> --}}
                                    <input type="date" class="form-control" id="updateEnd_service" name="end_service"
                                        value="{{ $data->end_service }}"
                                        @if ($data->service_type == 'Self Service') style="display: none" @elseif($data->executor !== $checkExecutor) disabled @endif>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small mb-1" for="solution">Solution</label>
                            <textarea id="solution" name="solution" class="form-control input-sm required" placeholder="Solution"
                                rows="3" @if ($data->executor !== $checkExecutor) disabled @endif>{{ $data->solution }}</textarea>
                        </div>
                    </div>

                    @if ($data->executor == $checkExecutor)
                        <div class="text-right">
                            <button type="submit" value="update" class="btn btn-warning btn-sm">Update Solution</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    @endif
    <div class="col-9 mt-5">
        <div class="col-auto mr-auto">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list mr-2"></i>Activity</h6>

        </div>
        <div class="activity column col-auto mb-5 mt-3">
            <ul>
                @forelse ($audits as $audit)
                    @if ($audit->event === 'created')
                        <li>
                            @lang('report.created', $audit->getMetadata())
                        </li>
                    @elseif ($audit->event !== 'created')
                        <li>
                            @lang('report.updated.metadata', $audit->getMetadata()) <span class="text-muted text-xs text-gray-500">@lang('' .   $audit->created_at)</span>
                            @foreach ($audit->getModified() as $attribute => $modified)
                                @if ($audit->status === '1')
                                @endif
                                <ul>
                                    <li>@lang('report.' . $audit->event . '.modified.' . $attribute, $modified)</li>
                                </ul>
                            @endforeach
                        </li>
                    @endif
                @empty
                    <p>@lang('report.unavailable_audits')</p>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
