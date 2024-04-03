@extends('layouts.master')

@section('title')
    Pengaturan User
@endsection


@section('content')
    @if (auth()->user()->roles == 'ADMIN')
        <div class="d-flex justify-content-between flex-column flex-sm-row mb-3">
            <h5>Data User</h5>
            <div class="my-lg-0 my-2 ">

                <div class="col-auto mr-auto">

                    <a href="/user/create" class="btn btn-sm btn-primary mb-lg-0 mb-3">+ Add New User</a>

                    <a href="/user/export/" class="btn btn-sm btn-success">Export to Excel</a>

                </div>

            </div>
        </div>
    @endif
    <div class="card">

        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="dataTable-container">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Name</th>
                                    <th>NIP</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created_at</th>
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
                                        <td> {{ $item->first_name }} {{ $item->last_name }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->roles }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        @if (auth()->user()->roles == 'ADMIN')
                                            <td>
                                                <a href="{{ url('user/show/user-' . $item->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ url('user/edit/user-' . $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm ml-1" data-toggle="modal"
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
