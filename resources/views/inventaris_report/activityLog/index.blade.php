@extends('layouts.master')
@section('title')
    Data Inventaris - Activity Log
@endsection

@section('content')
    <h5>Activity Log Report Inventaris</h5>
    <div class="card">
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="dataTable-container">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>User</th>
                                    <th>Activity</th>
                                    <th>Detail</th>
                                    <th>Source IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->user_name }}</td>
                                        <td>
                                            @if ($item->type_log == ' delete ')
                                                <span class="badge badge-danger">delete</span>
                                            @elseif($item->type_log == ' edited ')
                                                <span class="badge badge-warning">edited</span>
                                            @elseif($item->type_log == ' added ')
                                                <span class="badge badge-success">added</span>
                                            @endif
                                            {{ $item->event }} <span class="badge badge-primary">{{ $item->extra }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                        <td>{{ $item->ip }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
@endpush
