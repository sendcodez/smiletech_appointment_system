@extends('layouts.sidebar')
@section('contents')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>My Records</h4>

                    </div>
                </div>

            </div>
            <!-- row -->
            <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-xl-12"> 
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="full-map-area mb-4">
                                    <img src="{{ asset('images/tooth.jpg') }}" alt=""> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            
                                            <th>DATE</th>
                                            <th>TIME</th>
                                            <th>TOOTH NUMBER</th>
                                            <th>DESCRIPTION</th>       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @forelse($results as $res)
                                                <td>{{ $res->date }}</td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('h:i A', strtotime($res->time)) }}</td>
                                                <td>{{ $res->number }}</td>
                                                <td>{{ $res->description }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center">No data available</td>
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
