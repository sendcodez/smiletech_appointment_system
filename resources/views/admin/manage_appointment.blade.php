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

                                            @if (request()->routeIs('status.cancelled'))
                                                <th>REASON </th>
                                                <th>NO-SHOW</th>
                                            @endif


                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($manage_app as $app)
                                            <tr>
                                                <td>{{ $app->date }}</td>
                                                <td>
                                                    @if ($app->user)
                                                        {{ $app->user->firstname }} {{ $app->user->lastname }}
                                                    @else
                                                        <span class="text-danger">No user</span>
                                                    @endif
                                                </td>

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

                                                @if (request()->routeIs('status.cancelled'))
                                                    <td>{{ $app->cancellation_reason }}</td>
                                                    <td>
                                                        @if ($app->is_no_show)
                                                            <span class="badge badge-dark">No-Show</span>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
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
                                                                        <i class="dw dw-check"></i> Approve
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
                                                                        <i class="dw dw-delete-3"></i> Remove
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            {{-- Mark as No-Show (Admin only, for approved past appointments) --}}
                                                            @if (
                                                                (Auth::user()->usertype == 1 || Auth::user()->usertype == 2) &&
                                                                    $app->status == 2 &&
                                                                    !$app->is_no_show &&
                                                                    \Carbon\Carbon::parse($app->date)->isPast())
                                                                <form
                                                                    action="{{ route('appointments.markNoShow', $app->id) }}"
                                                                    method="POST" class="mark-noshow-form">
                                                                    @csrf
                                                                    <button type="button"
                                                                        class="dropdown-item mark-noshow-btn">
                                                                        <i class="fa fa-ban"></i> Mark as No-Show
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
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.date.js') }}"></script>

    <script>
        // Cancel appointment handler
        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');

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
                                const reasonInput = document.createElement('input');
                                reasonInput.type = 'hidden';
                                reasonInput.name = 'cancellation_reason';
                                reasonInput.value = inputResult.value;
                                form.appendChild(reasonInput);
                                form.submit();
                            }
                        });
                    }
                });
            });
        });

        // Delete appointment handler
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');

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
                        form.submit();
                    }
                });
            });
        });

        // Mark as No-Show handler
        document.querySelectorAll('.mark-noshow-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Mark as No-Show?',
                    text: 'This will apply penalties to the patient. Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, mark as no-show!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
