@extends('layouts.sidebar')
@section('contents')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Appointments</h4>

                    </div>
                </div>

            </div>
            <!-- row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>PATIENT NAME</th>
                                            <th>SERVICE</th>
                                            <th>DAY</th>
                                            <th>TIME</th>
                                            <th>REFERENCE NUMBER</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @forelse($patient_app as $app)
                                                <td>{{ $app->date }}</td>
                                                <td>{{ $app->user->firstname }} {{ $app->user->lastname }}</td>
                                                <td>{{ $app->service ? $app->service->name : "Not available" }}</td>
                                                <td>{{ $app->day }}</td>
                                                <td>{{ ucfirst($app->time) }}</td>
                                                <td>{{ $app->reference_number }}</td>
                                                <td>
                                                    @if ($app->status == 1)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($app->status == 2)
                                                        <span class="badge badge-success">Approved</span>
                                                    @elseif ($app->status == 3)
                                                        <span class="badge badge-primary">Completed</span>
                                                    @elseif ($app->status == 4)
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="dropdown ml-auto text-right">
                                                        <div class="btn-link text-center" data-toggle="dropdown">
                                                            <svg width="24px" height="24px" viewBox="0 0 24 24"
                                                                version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <circle fill="#000000" cx="5" cy="12"
                                                                        r="2"></circle>
                                                                    <circle fill="#000000" cx="12" cy="12"
                                                                        r="2"></circle>
                                                                    <circle fill="#000000" cx="19" cy="12"
                                                                        r="2"></circle>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right">

                                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#resultsModal{{ $app->id }}">
                                                                     Add Result
                                                            </button>
                                                            @if ($app->status == 1 || $app->status == 2)
                                                                <form action="{{ route('appointments.cancel', $app->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="dropdown-item cancel-btn">
                                                                        <i class="dw dw-cancel"></i> Cancel
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            <form action="{{ route('appointments.complete', $app->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="dropdown-item \">
                                                                    <i class="dw
                                                                    dw-tick"></i> Complete
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                        
                <div class="modal fade" id="resultsModal{{ $app->id }}" tabindex="-1" aria-labelledby="addUserModalLabel{{ $app->id }}"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-center">Treatment Information</h3>
                                <button type="button" id="close" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="multiStepForm" method="POST" action="{{route('results.store')}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Patient Name</label>
                                                <div class="form-group">
                                                    <input type="hidden" name="user_id" value="{{ $app->user_id }}"
                                                        class="form-control" readonly>
                                                    <input type="text" style="background-color: rgb(202, 197, 197)"
                                                        name="fullname" value="{{ $app->user->firstname }} {{ $app->user->middlename}} {{ $app->user->lastname}}"
                                                        class="form-control" readonly>
                                                </div>
                                                <label>Date</label>
                                                <div class="form-group">
                                                    <input type="date"
                                                        name="date" 
                                                        class="form-control">
                                                </div>
                                                <label>Time</label>
                                                <div class="form-group">
                                                    <input type="time"
                                                        name="time" 
                                                        class="form-control">
                                                </div>
                                                <label>Tooth Number</label>
                                                <div class="form-group">
                                                    <input type="number"
                                                        name="number"
                                                        class="form-control" >
                                                </div>
                                                <label>Description</label>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center">No data available</td>
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
    <script src="{{ asset('vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.date.js') }}"></script>


    <script>

        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission behavior

                const form = this.closest('form'); // Find the closest form element

                // Display SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        form.submit();
                    }
                });


            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission behavior

                const form = this.closest('form'); // Find the closest form element

                // Display SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        form.submit();
                    }
                });
            });
        });
        
        $(document).ready(function() {
            $('.modal .close').click(function() {
                $(this).closest('.modal').modal('hide');
            });
        });
    </script>
@endsection
