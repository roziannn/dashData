@extends('layouts.master')
@section('title')
    Data Inventaris - Semua Data
@endsection

@section('content')
    <h4>Inventory Problem Report</h4>

    @if (auth()->user()->roles == 'ADMIN')
        <div class="col-auto mt-2 mb-3">
            <a href="#" class="btn btn-sm btn-light text-primary" data-toggle="modal" data-target="#modal-primary">+ Create
                New Report</a>
            </a>
        </div>
    @endif
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
                                    <th>Status</th>
                                    <th>End Date</th>
                                    @if (auth()->user()->roles == 'ADMIN')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @php $i=1 @endphp
                                {{-- @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td> {{ $item->first_name }} {{ $item->last_name }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->roles }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            @if (auth()->user()->roles == 'ADMIN')
                                            <td>
                                                <a href="{{ url('user/edit/user-' . $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm ml-1" data-toggle="modal"
                                                    data-target="#modal-danger{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- danger modal --}}
        {{-- @foreach ($data as $item)
                <div class="modal fade" id="modal-danger{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/user-delete' . $item->id) }}" method="GET">
                                    {{ csrf_field() }}
                                    <p>Yakin ingin menghapus data?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-sm pull-left"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Hapus</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach --}}
        {{-- primary modal/ADD --}}
        <div class="modal fade" id="modal-primary">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="/inventaris/store" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="code">Token</label>
                                    <input class="form-control" id="code" name="code" type="text"
                                        placeholder="Enter item code" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="brand">Author</label>
                                    <input class="form-control" id="brand" name="brand" type="text"
                                        placeholder="Enter brand code" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="brand">Report Date</label>
                                    <input class="form-control" id="brand" name="brand" type="text"
                                        placeholder="Enter brand code" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inventarisCategory_name">Category</label>
                                    <select class="form-control input-group-sm select2" id='inventarisCategory_name'
                                        name="inventarisCategory_name" required>
                                        {{-- @foreach ($dataCategory as $data)
                                            <option></option>
                                            <option>{{ $data->inventarisCategory_name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="reg_code">Registration Code</label>
                                    <input class="form-control" id="reg_code" name="reg_code" type="reg_code"
                                        placeholder="Enter registration code" required>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="year">Year of Purchase</label>
                                    <input class="form-control" id="year" name="year" type="year"
                                        placeholder="Enter year of purchase" required>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="condition">Condition</label>
                                    <input class="form-control" id="condition" name="condition" type="text"
                                        placeholder="Enter item condition" required>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="location">Item Location</label>
                                    <input class="form-control" id="location" name="location" type="text"
                                        placeholder="Enter item location" required>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="department">Department</label>
                                    <input class="form-control" id="department" name="department" type="text"
                                        placeholder="Enter department" required>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="used_by">Used by</label>
                                    <input class="form-control" id="used_by" name="used_by" type="text"
                                        placeholder="Item used by" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="small mb-1" for="code">Others</label>
                                    <textarea id="others" name="others" class="form-control input-sm required" placeholder="Description"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-sm pull-left"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Save Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection