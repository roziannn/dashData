@extends('layouts.master')
@section('title')
    Data Inventaris - Category
@endsection

@section('content')
    <h4>Master Category Inventaris</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Create new category
                    </h6>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    @endif

                    <form>
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="inventarisCategory_name">Category Name</label>
                            <input class="form-control" id="inventarisCategory_name" name="inventarisCategory_name" type="text"
                                placeholder="Enter category name" required>
                        </div>
                        <!-- Submit button-->
                        <div class="text-right">
                            <button class="btn btn-light btn-sm text-primary" type="cancel">Cancel</button>
                            <button class="btn btn-primary btn-sm" type="submit">Add new category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Category List
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
                                            <th>Category Name</th>
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
                                @endforeach --}}
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
