@extends('layouts.sidebar')
@section('title', 'Activity Log')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Activity Log</h4>

                    </div>
                </div>

            </div>
            <!-- row -->


            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($activityLogs as $activity)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $activity->name }}</td>
                                                <td>{{ $activity->description }}</td>
                                                <td>{{ $activity->created_at->toDateString() }}</td>
                                                <td>{{ $activity->created_at->format('h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" style="text-align: center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@endsection
