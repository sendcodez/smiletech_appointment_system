@extends('layouts.sidebar')
@section('contents')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4> Manage Appointments</h4>

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
                                            @if (request()->routeIs('status.cancelled'))
                                                <th>REASON </th>
                                            @endif
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($manage_app as $app)
                                            <tr>
                                                <td>{{ $app->date }}</td>
                                                <td>{{ $app->user->firstname }} {{ $app->user->lastname }}</td>
                                                <td>
                                                    @if ($app->services->isNotEmpty())
                                                        {{ $app->services->pluck('name')->implode(', ') }}
                                                    @else
                                                        <span class="text-muted">Not available</span>
                                                    @endif
                                                </td>
                                                <td>{{ $app->day }}</td>
                                                <td>{{ ucfirst($app->time) }}</td>
                                                <td>{{ $app->reference_number }}</td>
                                                <td>
                                                    @if ($app->status == 1)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($app->status == 2)
                                                        <span class="badge badge-primary">Approved</span>
                                                    @elseif ($app->status == 3)
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif ($app->status == 4)
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                @if (request()->routeIs('status.cancelled'))
                                                    <td>{{ $app->cancellation_reason }}</td>
                                                @endif


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

                                                            @if ($app->status == 1)
                                                                <form action="{{ route('appointments.approve', $app->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="dw dw-cancel"></i> Approve
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            @if ($app->status == 1 || $app->status == 2)
                                                                <form action="{{ route('appointments.cancel', $app->id) }}"
                                                                    method="POST" class="cancel-form">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="button" class="dropdown-item cancel-btn">
                                                                        <i class="dw dw-cancel"></i> Cancel
                                                                    </button>
                                                                    <input type="hidden" name="cancellation_reason"
                                                                        id="cancellation_reason_{{ $app->id }}">
                                                                </form>
                                                            @endif

                                                            @if ($app->status == 4 || $app->status == 3)
                                                                <form
                                                                    action="{{ route('appointments.destroy', $app->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item delete-btn">
                                                                        <i class="dw dw-cancel"></i> Remove
                                                                    </button>
                                                                </form>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" style="text-align: center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-center">Appointment Information</h3>
                                <button type="button" id="close" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="multiStepForm" method="POST" action="{{ route('appointment.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>First Name</label>
                                                <div class="form-group">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"
                                                        class="form-control" readonly>
                                                    <input type="text" style="background-color: rgb(202, 197, 197)"
                                                        name="firstname" value="{{ Auth::user()->firstname }}"
                                                        class="form-control" readonly>
                                                </div>
                                                <label>Middle Name</label>
                                                <div class="form-group">
                                                    <input type="text" style="background-color: rgb(202, 197, 197)"
                                                        name="middlename" value="{{ Auth::user()->middlename }}"
                                                        class="form-control" readonly>
                                                </div>
                                                <label>Last Name</label>
                                                <div class="form-group">
                                                    <input type="text" style="background-color: rgb(202, 197, 197)"
                                                        name="lastname" value="{{ Auth::user()->lastname }}"
                                                        class="form-control" readonly>
                                                </div>
                                                <label>Select Service*</label>
                                                <div class="form-group">
                                                    <select id="serviceSelect" name="service_id" class="form-control"
                                                        required>
                                                        <option value="">Select Service</option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label>Select Date*</label>
                                                <div class="form-group">
                                                    <input name="date" class="datepicker-default form-control"
                                                        id="datepicker">
                                                </div>

                                                <div class="form-group">
                                                    <label>Select Time*</label>
                                                    <div id="timeSlots" name="time" required>

                                                    </div>
                                                </div>

                                                <label>Day</label>
                                                <div class="form-group">
                                                    <input name="day" style="background-color: rgb(202, 197, 197)"
                                                        class="form-control" id="day" readonly>
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

            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.date.js') }}"></script>


    <script>
        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const form = this.closest('form'); // Find the closest form element

                // Show confirmation dialog
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
                        // Show the second SweetAlert asking for a cancellation reason
                        Swal.fire({
                            title: 'Cancellation Reason',
                            input: 'textarea',
                            inputLabel: 'Please provide a reason for cancellation:',
                            inputPlaceholder: 'Type your reason here...',
                            inputAttributes: {
                                'aria-label': 'Cancellation reason'
                            },
                            showCancelButton: true
                        }).then((inputResult) => {
                            if (inputResult.isConfirmed) {
                                // Append the reason as a hidden input in the form
                                const reasonInput = document.createElement('input');
                                reasonInput.type = 'hidden';
                                reasonInput.name = 'cancellation_reason';
                                reasonInput.value = inputResult
                                    .value; // Capture the reason text

                                // Append the reason input to the form
                                form.appendChild(reasonInput);

                                // Submit the form with the cancellation reason
                                form.submit();
                            }
                        });
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
    </script>
@endsection
