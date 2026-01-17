@extends('layouts.sidebar')
@section('contents')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        @php
                            $hasAppointment = \App\Models\Appointment::where('user_id', Auth::id())
                                ->whereIn('status', [1, 2])
                                ->exists();

                            $eligibility = app(\App\Services\PenaltyService::class)->checkUserEligibility(Auth::user());
                            $penalty = Auth::user()->penalty;
                        @endphp

                        {{-- Add penalty warning banner after page-titles --}}
                        @if ($penalty && $penalty->no_show_count > 0)
                            <div class="row">
                                <div class="col-12">
                                    @if ($penalty->isCurrentlyBlocked())
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <strong>Account Blocked!</strong> {{ $penalty->penalty_reason }}
                                            @if ($penalty->blocked_until)
                                                <br>Your account will be unblocked on:
                                                <strong>{{ $penalty->blocked_until->format('F d, Y h:i A') }}</strong>
                                            @endif
                                        </div>
                                    @else
                                        <div class="alert alert-warning alert-dismissible fade show">
                                            <strong>Warning!</strong> You have
                                            <strong>{{ $penalty->no_show_count }}</strong> no-show
                                            appointment(s).
                                            {{ $penalty->penalty_reason }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Update the modal to show block status --}}
                        @if (!$eligibility['eligible'])
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    document.querySelector("#multiStepForm").style.pointerEvents = 'none';
                                    document.querySelector("#multiStepForm").style.opacity = '0.5';
                                });
                            </script>
                        @elseif ($hasAppointment)
                            {{-- Your existing hasAppointment alert --}}
                        @endif

                        <h4>Appointments</h4>

                    </div>
                </div>

            </div>
            <!-- row -->


            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal"
                                data-bs-target="#addUserModal"> ADD APPOINTMENT
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <!--  <th>#</th> -->
                                            <th>DATE</th>
                                            <th>SERVICE</th>
                                            <th>DAY</th>
                                            <th>TIME PERIOD</th>
                                            <th>REFERENCE NUMBER</th>
                                            <th>APPOINTMENT TYPE</th>
                                            <th>STATUS</th>
                                            <th>REASON <i><small>(IF CANCELLED)</small></i></th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @forelse($appointments as $app)
                                                <!-- <td>{{ $loop->iteration }}</td> -->
                                                <td>{{ $app->date }}</td>
                                                <td>
                                                    @if ($app->services->isNotEmpty())
                                                        {{ $app->services->pluck('name')->implode(', ') }}
                                                    @else
                                                        <span class="text-muted">Not available</span>
                                                    @endif
                                                </td>


                                                <td>{{ $app->day }}</td>
                                                <td>
                                                    @if ($app->time === 'morning')
                                                        Morning (8:00am - 11:00am)
                                                    @elseif($app->time === 'afternoon')
                                                        Afternoon (1:00pm - 5:00pm)
                                                    @else
                                                        {{ ucfirst($app->time) }}
                                                    @endif
                                                </td>

                                                <td>{{ $app->reference_number }}</td>
                                                <td>
                                                    @if ($app->appointment_type == 1)
                                                        Appointment for myself
                                                    @elseif ($app->appointment_type == 0)
                                                        Appointment for {{ ucfirst($app->name) }}
                                                    @endif
                                                </td>
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
                                                <td>{{ $app->cancellation_reason ?? '-' }}</td>
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
                                                                    <button type="submit" class="dropdown-item cancel-btn">
                                                                        <i class="dw dw-cancel"></i> Remove
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            @if ($app->status == 1 || $app->status == 2)
                                                                <button type="button" class="dropdown-item"
                                                                    data-toggle="modal"
                                                                    data-target="#rescheduleModal_{{ $app->id }}">
                                                                    <i class="dw dw-calendar1"></i> Reschedule
                                                                </button>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center">No data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                @foreach ($appointments as $app)
                                    @if ($app->status == 1 || $app->status == 2)
                                        <div class="modal fade" id="rescheduleModal_{{ $app->id }}" tabindex="-1"
                                            aria-labelledby="rescheduleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('appointments.reschedule') }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="appointment_id"
                                                            value="{{ $app->id }}">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Reschedule Appointment</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>New Date</label>
                                                                <input type="date" name="date" class="form-control"
                                                                    value="{{ $app->date }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>New Time Period</label>
                                                                <select name="time" class="form-control" required>
                                                                    <option value="morning"
                                                                        {{ $app->time == 'morning' ? 'selected' : '' }}>
                                                                        Morning (8:00am - 11:00am)
                                                                    </option>
                                                                    <option value="afternoon"
                                                                        {{ $app->time == 'afternoon' ? 'selected' : '' }}>
                                                                        Afternoon (1:00pm - 5:00pm)
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save
                                                                Changes</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

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
                                @if ($hasAppointment)
                                    <div class="alert alert-warning">
                                        You already have a ongoing appointment.
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            document.querySelector("#multiStepForm").style.pointerEvents = 'none';
                                            document.querySelector("#multiStepForm").style.opacity = '0.5';
                                        });
                                    </script>
                                @endif
                                <form id="multiStepForm" method="POST" action="{{ route('appointment.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Appointment Type</label>
                                                <div class="form-group">
                                                    <select id="appointmentType" class="form-control"
                                                        onchange="toggleFields()" name="appointment_type">
                                                        <option value="1">Appointment for myself</option>
                                                        <option value="0">Appointment for someone</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"
                                                    class="form-control" readonly>
                                                <div id="someoneNameWrapper" style="display: none;">
                                                    <label>Name of the Person</label>
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="name"
                                                            class="form-control" placeholder="Enter full name">
                                                    </div>
                                                </div>

                                                <label>Select Service*</label>
                                                <div class="form-group">
                                                    <select id="serviceSelect" name="service_id[]" class="form-control"
                                                        multiple required>
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
                                                    <label>Select Time Period*</label>
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
                                    <div class="form-group mt-3">
                                        <div
                                            style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; max-height: 100px; overflow-y: auto; font-size: 14px;">
                                            <strong>Terms & Conditions:</strong>
                                            <p>
                                                By submitting this appointment, you agree to attend on the selected date and
                                                time.
                                                Any cancellations must be made at least 24 hours in advance. Failure to
                                                attend without prior notice may limit future bookings.
                                            </p>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input type="checkbox" class="form-check-input" id="agreeTerms">
                                            <label class="form-check-label" for="agreeTerms">I agree to the terms and
                                                conditions</label>
                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal"
                                            id="submitBtn" disabled>
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
        $(document).on('change', '#datepicker', function() {
            var selectedDate = $(this).val();
            console.log('Selected date:', selectedDate); // Check if selected date is captured

            $.ajax({
                url: '/get-appointments',
                method: 'GET',
                data: {
                    date: selectedDate
                },
                success: function(response) {
                    console.log('Response from server:', response); // Check the response

                    // Extract booked counts and max appointments from response
                    var bookedMorningCount = response.bookedMorningCount.length > 0 ? response
                        .bookedMorningCount[0].count : 0;
                    var bookedAfternoonCount = response.bookedAfternoonCount.length > 0 ? response
                        .bookedAfternoonCount[0].count : 0;
                    var maxMorningAppointments = parseInt(response.maxMorningAppointments);
                    var maxAfternoonAppointments = parseInt(response.maxAfternoonAppointments);

                    console.log('Booked morning count:', bookedMorningCount);
                    console.log('Booked afternoon count:', bookedAfternoonCount);
                    console.log('Max morning appointments:', maxMorningAppointments);
                    console.log('Max afternoon appointments:', maxAfternoonAppointments);

                    // Clear existing time slots before appending new ones
                    $('#timeSlots').empty();

                    // Append morning radio button
                    if (bookedMorningCount >= maxMorningAppointments) {
                        $('#timeSlots').append(
                            '<label><input type="radio" name="time" value="morning" disabled> Morning (Not Available)</label><br>'
                        );
                        console.log('Morning option disabled');
                    } else {
                        $('#timeSlots').append(
                            '<label><input type="radio" name="time" value="morning"> Morning (8:00am - 11:00am)</label><br>'
                        );
                        console.log('Morning option enabled');
                    }

                    // Append afternoon radio button
                    if (bookedAfternoonCount >= maxAfternoonAppointments) {
                        $('#timeSlots').append(
                            '<label><input type="radio" name="time" value="afternoon" disabled> Afternoon (Not Available)</label>'
                        );
                        console.log('Afternoon option disabled');
                    } else {
                        $('#timeSlots').append(
                            '<label><input type="radio" name="time" value="afternoon"> Afternoon (1:00pm - 4:00pm)</label>'
                        );
                        console.log('Afternoon option enabled');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Check for any errors
                }

            });
        });

        var storeCloseDays = {!! json_encode($storeCloseDays) !!};
        var bookedMorningCount = {!! json_encode($bookedMorningCount) !!};
        var bookedAfternoonCount = {!! json_encode($bookedAfternoonCount) !!};
        var maxMorningAppointments = {!! json_encode($maxMorningAppointments) !!};
        var maxAfternoonAppointments = {!! json_encode($maxAfternoonAppointments) !!};

        console.log("storeCloseDays:", storeCloseDays);
        console.log("bookedMorningCount:", bookedMorningCount);
        console.log("bookedAfternoonCount:", bookedAfternoonCount);
        console.log("maxMorningAppointments:", maxMorningAppointments);
        console.log("maxAfternoonAppointments:", maxAfternoonAppointments);


        var disabledDays = [];
        var fullyBookedDates = [];

        storeCloseDays.forEach(function(dayName) {
            console.log("Checking day:", dayName);


            var dayNumber = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']
                .findIndex(function(day) {
                    return day.toLowerCase() === dayName.toLowerCase();
                });
            console.log("Mapped day number:", dayNumber);
            if (dayNumber !== -1) {
                var disabledDay = dayNumber + 1;
                disabledDays.push(disabledDay);

            }

        });

        bookedMorningCount.forEach(function(morning) {
            var fullyBooked = bookedAfternoonCount.find(function(afternoon) {
                return morning.date === afternoon.date && morning.count >= maxMorningAppointments &&
                    afternoon.count >= maxAfternoonAppointments;
            });

            if (fullyBooked) {
                fullyBookedDates.push(morning.date);
            }
        });


        console.log("Disabled days:", disabledDays);
        console.log("Fully booked dates:", fullyBookedDates);

        fullyBookedDates = fullyBookedDates.map(function(dateString) {
            return new Date(dateString);
        });
        var mergedDisabledDates = disabledDays.concat(fullyBookedDates);

        console.log("Merged disabled dates:", mergedDisabledDates);


        var datePicker = $('#datepicker').pickadate({
            format: 'yyyy-mm-dd',
            disable: mergedDisabledDates,
            min: true
        }).pickadate('picker');


        function updateDayField() {
            var selectedDate = datePicker.get('select', 'yyyy-mm-dd');

            if (selectedDate) {
                var dayOfWeek = new Date(selectedDate).toLocaleDateString('en-US', {
                    weekday: 'long'
                });
                $('#day').val(dayOfWeek);
            } else {
                $('#day').val('No Date Selected');
            }
        }


        datePicker.on('set', function() {
            updateDayField();
        });
        updateDayField();

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


        $(document).ready(function() {
            $('.modal .close').click(function() {
                $(this).closest('.modal').modal('hide');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const agreeCheckbox = document.getElementById('agreeTerms');
            const submitBtn = document.getElementById('submitBtn');

            agreeCheckbox.addEventListener('change', function() {
                submitBtn.disabled = !agreeCheckbox.checked;
            });
        });


        function toggleFields() {
            const type = document.getElementById('appointmentType').value;

            const fields = ['firstname', 'middlename', 'lastname'];
            const someoneWrapper = document.getElementById('someoneNameWrapper');

            if (type === '0') {
                // Show "Name of the Person"
                someoneWrapper.style.display = 'block';

                fields.forEach(id => {
                    const field = document.getElementById(id);
                    field.readOnly = false;
                    field.value = '';
                    field.style.backgroundColor = '#fff';
                });
            } else {
                // Hide "Name of the Person"
                someoneWrapper.style.display = 'none';
                document.getElementById('name').value = '';

                fields.forEach(id => {
                    const field = document.getElementById(id);
                    field.readOnly = true;
                    field.style.backgroundColor = 'rgb(202, 197, 197)';
                });

                // Restore user data
                document.getElementById('firstname').value = "{{ Auth::user()->firstname }}";
                document.getElementById('middlename').value = "{{ Auth::user()->middlename }}";
                document.getElementById('lastname').value = "{{ Auth::user()->lastname }}";
            }
        }
    </script>
@endsection
