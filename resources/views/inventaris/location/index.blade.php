@extends('layouts.master')
@section('title')
    Data Office Room - Location
@endsection

@section('content')
    <h5 class="mb-3">List Office Room</h5>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('successDelete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('successDelete') }}
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
                                            <th>Room Name</th>
                                            <th>Floor</th>
                                            @if (auth()->user()->roles == 'ADMIN')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $item->location }}</td>
                                                <td> {{ $item->floor }}</td>
                                                @if (auth()->user()->roles == 'ADMIN')
                                                    <td>
                                                        <a href="#" class="btn-danger btn-sm ml-1" data-toggle="modal"
                                                            data-target="#modal-danger{{ $item->id }}">
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
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

                <div class="card-body">
                    <h6 class="mb-3 font-weight-bold text-primary">
                        Create New Room
                    </h6>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    @endif
                    <form action="/master/inventaris_location/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="location">Room Name</label>
                            <input class="form-control" id="location" name="location" type="text"
                                placeholder="Enter room name" required>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="floor">Floor</label>
                            <input class="form-control" id="floor" name="floor" type="text"
                                placeholder="Enter floor name" required>
                        </div>
                        <!-- Submit button-->
                        <div class="text-right">
                            <button class="btn btn-primary btn-sm w-100" type="submit">Add new room</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- danger modal --}}
        @foreach ($data as $item)
            <div class="modal fade" id="modal-danger{{ $item->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/master/inventaris_location/delete' . $item->id) }}" method="GET">
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
