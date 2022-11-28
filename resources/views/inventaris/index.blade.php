@extends('layouts.master')
@section('title')
    Data Inventaris - Semua Data
@endsection

@section('content')
    <h4>Data Inventaris</h4>
    <div class="card">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <a href="#" class="btn-sm btn-light text-primary text-decoration-none" data-toggle="modal"
                        data-target="#modal-primary">+ Add data</a>
                </div>
                <div class="row">
                    <div class="text-right">
                        <div class="col-sm-3 mr-3">
                            <!-- Fade In Animation -->
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" id="dropdownFadeIn"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</button>
                                <div class="dropdown-menu animated--fade-in" name="category" aria-labelledby="dropdownFadeIn">
                                    @foreach ($dataCategory as $item )
                                        <a class="dropdown-item" href="/inventaris/{{ $item->inventarisCategory_name }}" value="{{ $item->inventarisCategory_name }}">{{ $item->inventarisCategory_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
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
            @if (session()->has('successDelete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('successDelete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif
            @if (session()->has('successUpdate'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('successUpdate') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="dataTable-container">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Location</th>
                                    <th>Year</th>
                                    <th>Department</th>
                                    <th>Used by</th>
                                    @if (auth()->user()->roles == 'ADMIN')
                                        <th width="10%">Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($dataItem as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->inventarisCategory_name }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->year }}</td>
                                        <td>{{ $item->department }}</td>
                                        <td>{{ $item->used_by }}</td>

                                        @if (auth()->user()->roles == 'ADMIN')
                                            <td>
                                                <a href="#"
                                                    class="btn-warning btn-sm ml-1 text-decoration-none"data-toggle="modal"
                                                    data-target="#modal-primary{{ $item->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn-danger btn-sm ml-1 text-decoration-none"
                                                    data-toggle="modal" data-target="#modal-danger{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- danger modal --}}
        @foreach ($dataItem as $item)
            <div class="modal fade" id="modal-danger{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/inventaris/item-delete' . $item->id) }}" method="GET">
                                {{ csrf_field() }}
                                <p>Yakin ingin menghapus item?</p>
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
        @endforeach
        {{-- primary modal/ADD --}}
        <div class="modal fade" id="modal-primary">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add inventaris item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="/inventaris/store" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="code">Code</label>
                                    <input class="form-control" id="code" name="code" type="text"
                                        placeholder="Enter item code" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="brand">Brand</label>
                                    <input class="form-control" id="brand" name="brand" type="text"
                                        placeholder="Enter brand code" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inventarisCategory_name">Category</label>
                                    <select class="form-control input-group-sm select2" id='inventarisCategory_name'
                                        name="inventarisCategory_name" required>
                                        @foreach ($dataCategory as $data)
                                            <option></option>
                                            <option>{{ $data->inventarisCategory_name }}</option>
                                        @endforeach
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
                                    <label class="small mb-1" for="department">Department/Division</label>
                                    <select class="form-control input-group-sm" id='department' name="department"
                                        required>
                                        @foreach ($dataDepartment as $item)
                                            <option>{{ $item->department_name }}</option>
                                        @endforeach
                                    </select>
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
        {{-- primary modal/UPDATE --}}
        @foreach ($dataItem as $item)
            <div class="modal fade" id="modal-primary{{ $item->id }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/inventaris/update' . $item->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="code">Code</label>
                                        <input class="form-control" id="code" name="code" type="text"
                                            value="{{ $item->code }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="brand">Brand</label>
                                        <input class="form-control" id="brand" name="brand" type="text"
                                            value="{{ $item->brand }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="inventarisCategory_name">Category</label>
                                        <select class="form-control input-group-sm select2" id="inventarisCategory_name"
                                            name="inventarisCategory_name" required>
                                            <option>{{ $item->inventarisCategory_name }}</option>
                                            @foreach ($dataCategory as $data)
                                                <option>{{ $data->inventarisCategory_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="reg_code">Registration Code</label>
                                        <input class="form-control" id="reg_code" name="reg_code" type="text"
                                            value="{{ $item->reg_code }}" required>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="year">Year of Purchase</label>
                                        <input class="form-control" id="year" name="year" type="text"
                                            value="{{ $item->year }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="condition">Condition</label>
                                        <input class="form-control" id="condition" name="condition" type="text"
                                            value="{{ $item->condition }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="location">Item Location</label>
                                        <input class="form-control" id="location" name="location" type="text"
                                            value="{{ $item->location }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="department">Department</label>
                                        <input class="form-control" id="department" name="department" type="text"
                                            value="{{ $item->department }}">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="used_by">Used by</label>
                                        <input class="form-control" id="used_by" name="used_by" type="text"
                                            value="{{ $item->used_by }}">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="small mb-1" for="others">Others</label>
                                        <textarea id="others" name="others" class="form-control input-sm required" placeholder="Description"
                                            rows="3">{{ $item->others }}</textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#inventarisCategory_name").select2({
                placeholder: "Search Category",
            });
        });
    </script>
@endpush
