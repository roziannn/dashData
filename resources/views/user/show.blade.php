@extends('layouts.master')

@section('title')
    Detail User
@endsection

@section('content')
    <div class="col-auto mt-2 mb-3">
        <a href="/user/index" class="btn btn-sm btn-light text-primary">kembali</a>
    </div>
    <div class="card mb-3">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-12 col-md-auto px-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        User Details
                    </h6>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="first_name">First name</label>
                    <input class="form-control" placeholder="Enter your first name" value="{{ $data->first_name }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="last_name">Last name</label>
                    <input class="form-control" readonly value="{{ $data->last_name }}">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="small mb-1" for="nip">Username</label>
                    <input class="form-control" readonly value="{{ $data->nip }}">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="small mb-1" for="email">Email address</label>
                    <input class="form-control" readonly value="{{ $data->email }}">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="small mb-1" for="roles">Roles</label>
                    <input class="form-control" readonly value="{{ $data->roles }}">
                </div>
                <div class="col-md-6 mt-3">
                    <label class="small mb-1" for="last_login">Last Login</label>
                    <input class="form-control" readonly value="{{ $data->last_login_at }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-12 col-md-auto px-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Activity
                    </h6>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul>
                @forelse ($audits as $audit)
                    <li>
                        @lang('article.updated.metadata', $audit->getMetadata())

                        @foreach ($audit->getModified() as $attribute => $modified)
                            <ul>
                                <li>@lang('article.' . $audit->event . '.modified.' . $attribute, $modified)</li>
                            </ul>
                        @endforeach
                    </li>
                @empty
                    <p>@lang('article.unavailable_audits')</p>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
