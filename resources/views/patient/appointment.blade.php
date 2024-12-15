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
                                            <th>TIME</th>
                                            <th>REFERENCE NUMBER</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @forelse($appointments as $app)
                                               <!-- <td>{{ $loop->iteration }}</td> -->
                                               <td>{{ $app->date }}</td>
                                                <td>{{ $app->service ? $app->service->name : "Not available" }}</td>
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
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="dropdown-item cancel-btn">
                                                                        <i class="dw dw-cancel"></i> Cancel
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            @if ($app->status == 4 || $app->status == 3)
                                                                <form action="{{ route('appointments.destroy', $app->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item cancel-btn">
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
                                            <td colspan="7" style="text-align: center">No data available</td>
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
                            '<label><input type="radio" name="time" value="morning"> Morning</label><br>'
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
                            '<label><input type="radio" name="time" value="afternoon"> Afternoon</label>'
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
