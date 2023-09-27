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
                    <a href="#" class="btn btn-sm btn-primary text-white text-decoration-none" data-toggle="modal"
                        data-target="#modal-primary">+ Add data</a>
                </div>
                <div class="row">
                    <div class="text-right">
                        <div class="col-sm-3 mr-3">
                            <!-- Fade In Animation -->
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" id="dropdownFadeIn"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</button>
                                <div class="dropdown-menu animated--fade-in" name="category"
                                    aria-labelledby="dropdownFadeIn">
                                    <a class="dropdown-item category-filter" href="#" data-category="all">All
                                        Category</a>
                                    <a class="dropdown-item category-filter" href="#"> </a>
                                    @foreach ($dataCategory as $item)
                                        <a class="dropdown-item category-filter" href="#"
                                            data-category="{{ $item->inventarisCategory_name }}">{{ $item->inventarisCategory_name }}</a>
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
                                    <th>Condition</th>
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
                                        <td>{{ $item->condition }}</td>
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
                                    <select class="form-control input-group-sm select2" id="brand" name="brand"
                                        required>
                                        <option>Apple</option>
                                        <option>Asus</option>
                                        <option>Dell</option>
                                        <option>HP</option>
                                        <option>Lenovo</option>
                                        <option>Samsung</option>
                                        <option>Toshiba</option>
                                        <option>Xiaomi</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inventarisCategory_name">Category</label>
                                    <select class="form-control input-group-sm select2" id='inventarisCategory_name'
                                        name="inventarisCategory_name" required>
                                        @foreach ($dataCategory as $data)
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
                                    <select class="form-control input-group-sm select2" id='year' name="year"
                                        required>
                                        @for ($year = 2023; $year >= 1990; $year--)
                                            <option>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="condition">Condition</label>
                                    <select class="form-control input-group-sm select2" id='condition' name="condition"
                                        required>
                                        <option>Good</option>
                                        <option>Needs Repair</option>
                                        <option>Needs Maintenance</option>
                                        <option>Repair</option>
                                        <option>Maintenance</option>
                                        <option>Damaged</option>
                                        <option>On Loan</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="small mb-1" for="location">Item Location</label>
                                    <select class="form-control input-group-sm select2" id='location' name="location"
                                        required>
                                        @foreach ($dataLocation as $data)
                                            <option>{{ $data->location }}</option>
                                        @endforeach
                                    </select>
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
                                        <select class="form-control input-group-sm select2" id="brand" name="brand"
                                            required>
                                            <option>{{ $item->brand }}</option>
                                            <option>Apple</option>
                                            <option>Asus</option>
                                            <option>Dell</option>
                                            <option>HP</option>
                                            <option>Lenovo</option>
                                            <option>Samsung</option>
                                            <option>Toshiba</option>
                                            <option>Xiaomi</option>
                                            <option>Others</option>
                                        </select>
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
                                        <select class="form-control input-group-sm select2" id='year' name="year"
                                            required>
                                            <option>{{ $item->year }}</option>
                                            @for ($year = 2023; $year >= 1990; $year--)
                                                <option>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="condition">Condition</label>
                                        <select class="form-control input-group-sm select2" id='condition'
                                            name="condition" required>
                                            <option>{{ $item->condition }}</option>
                                            <option>Good</option>
                                            <option>Needs Repair</option>
                                            <option>Needs Maintenance</option>
                                            <option>Repair</option>
                                            <option>Maintenance</option>
                                            <option>Damaged</option>
                                            <option>On Loan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="location">Item Location</label>
                                        <select class="form-control input-group-sm select2" id="location"
                                            name="location" required>
                                            <option>{{ $item->location }}</option>
                                            @foreach ($dataLocation as $data)
                                                <option>{{ $data->location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="small mb-1" for="department">Department</label>
                                        <select class="form-control input-group-sm select2" id="department"
                                            name="department" required>
                                            <option>{{ $item->department }}</option>
                                            @foreach ($dataDepartment as $data)
                                                <option>{{ $data->department_name }}</option>
                                            @endforeach
                                        </select>

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
                            <div class="tambahan">
                                <h5>Activity Log</h5>
                                <hr>
                                @foreach ($activityEdits as $activity)
                                    @if ($item->id == $activity->inventary_id)
                                        {{ $activity->user->first_name }}  edited {{ $activity->field }} from {{ $activity->old_value }} to {{ $activity->new_value }}
                                        <small class="text-muted text-gray-500">{{ $activity->created_at->format('l jS, F Y h:i:s A') }}</small>
                                        @endif
                                @endforeach
                            </div>
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

    <script>
        $('.category-filter').click(function(e) {
            e.preventDefault();

            var selectedCategory = $(this).data('category'); //get nilai kategori yang dipilih
            if (selectedCategory === 'all') {
                $('tbody tr').show();
            } else {
                $('tbody tr').hide();

                $('tbody tr').each(function() {
                    var category = $(this).find('td:eq(2)').text(); // Kolom "Category" berada di indeks 2
                    if (category ===
                        selectedCategory) { // get rows yang sesuai dengan kategori yang dipilih
                        $(this).show();
                    }
                });
            }
        });
    </script>
@endpush
