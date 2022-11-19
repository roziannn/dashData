@extends('layouts.master')
@section('title')
    Data Inventaris - Semua Data
@endsection

@section('content')
    @if (session()->has('successDelete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('successDelete') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    @endif
    <h4>Inventory Problem Report</h4>
    {{-- @if (auth()->user()->roles == 'ADMIN') --}}
        <div class="col-auto mt-2 mb-3">
            <a href="/inventaris/report/create" class="btn btn-sm btn-light text-primary">+ Create New Report</a>
        </div>
    {{-- @endif --}}
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                User List
            </h6>
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="dataTable-container">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Token</th>
                                    <th>Report Date</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Service Type</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td> {{ $item->report_token }}</td>
                                        <td>{{ $item->report_date }}</td>
                                        <td>{{ $item->author }}</td>
                                        <td>{{ $item->inventarisCategory_name }}</td>
                                        <td>{{ $item->service_type }}</td>
                                        <td>@if($item->status == 1)
                                            <span class="badge badge-pill badge-primary">solution added</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y, h:i ', strtotime($item->updated_at)) }}</td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td> --}}
                                        <td>
                                            <a href="{{ url('/inventaris/report/show/' . $item->id) }}"
                                                class="btn-primary btn-sm" style="text-decoration: none;">
                                                    <i class="fas fa-eye"></i>
                                            </a>
                                            @if ($item->author == $checkActionAccess)
                                                <a href="{{ url('/inventaris/report/edit/' . $item->id) }}"
                                                    class="btn-warning btn-sm ml-1" style="text-decoration: none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn-danger btn-sm ml-1" data-toggle="modal"
                                                    data-target="#modal-danger{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- danger modal --}}
        @foreach ($data as $item)
            <div class="modal fade" id="modal-danger{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/inventaris/report/delete' . $item->id) }}" method="GET">
                                {{ csrf_field() }}
                                <p>Are you sure to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light btn-sm pull-left"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                stateSave: true
            });
        });
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.js"></script>
@endpush
