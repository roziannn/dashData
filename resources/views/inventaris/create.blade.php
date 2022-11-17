@extends('layouts.master')
@section('title')
    Data Inventaris - Semua Data
@endsection

@section('content')
    <h4>Create Data Inventaris</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-12 col-md-auto px-2">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Item Details
                            </h6>
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

                    <form action="/inventaris/store" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Code</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Brand</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Category</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Registration Code</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Year of Purchase</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Condition</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                         
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Item Location</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Department</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small mb-1" for="email">Used by</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email address" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
