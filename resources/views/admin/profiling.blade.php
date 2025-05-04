@extends('layouts.sidebar')
@section('title', 'Patients Information')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Patients Information</h4>

                    </div>
                </div>

            </div>
            <!-- row -->


            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal"
                                data-bs-target="#addUserModal"> ADD PATIENT
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                        
                                            <th>FULL NAME</th>
                                            <th>BIRTHDAY</th>
                                            <th>AGE</th>
                                            <th>SEX</th>
                                            <th>CONTACT NUMBER</th>
                                            <th>ADDRESS</th>
                                            <th>OCCUPATION</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients as $patient)
                                            <tr>
                                                
                                                <td>{{ $patient->firstname }} {{ $patient->middlename }}
                                                    {{ $patient->firstnamelastname }}</td>
                                                <td>{{ $patient->birthday }} </td>
                                                <td>{{ $patient->age }}</td>
                                                <td>{{ ucfirst($patient->sex) }}</td>
                                                <td>{{ $patient->contact_number }}</td>
                                                <td>{{ $patient->address }}</td>
                                                <td>{{ $patient->occupation }}</td>
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

                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $patient->id }}">
                                                                <i class="dw dw-edit2"></i>Edit
                                                            </button>
                                                            <form action="{{ route('patients.destroy', $patient->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="deleteForm{{ $patient->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item delete-btn">
                                                                    <i class="dw dw-trash"></i>Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editModal{{ $patient->id }}" tabindex="-1"
                                                aria-labelledby="addUserModalLabel{{ $patient->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="text-center">Patient Informations</h3>
                                                            <button type="button" id="close" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="multiStepForm" method="POST"
                                                                action="{{ route('patients.update', $patient->id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>First Name</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="firstname"
                                                                                class="form-control"
                                                                                value="{{ $patient->firstname }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Middle Name</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="middlename"
                                                                                value="{{ $patient->middlename }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Last Name</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="lastname"
                                                                                value="{{ $patient->lastname }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>Birthday</label>
                                                                        <div class="form-group">
                                                                            <input type="date" id="edit_birthday"
                                                                                name="birthday"
                                                                                value="{{ $patient->birthday }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Age</label>
                                                                        <div class="form-group">
                                                                            <input type="number" id="edit_age"
                                                                                name="age"
                                                                                value="{{ $patient->age }}"
                                                                                class="form-control"
                                                                                style="background-color: rgb(202, 197, 197)"
                                                                                required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <label>Sex</label>
                                                                        <div class="form-group">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="sex"
                                                                                    id="female" value="female"
                                                                                    {{ $patient->sex == 'female' ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="female">
                                                                                    Female
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="sex"
                                                                                    id="male" value="male"
                                                                                    {{ $patient->sex == 'male' ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="male">
                                                                                    Male
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>Contact Number</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="contact_number"
                                                                                value="{{ $patient->contact_number }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Occupation</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="occupation"
                                                                                value="{{ $patient->occupation }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Address</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="address"
                                                                                value="{{ $patient->address }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-danger">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Reset</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1"
                                                                        data-bs-dismiss="modal">
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

                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-center">Patient Informations</h3>
                                <button type="button" id="close" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="multiStepForm" method="POST" action="{{ route('patients.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>First Name</label>
                                            <div class="form-group">
                                                <input type="text" name="firstname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Middle Name</label>
                                            <div class="form-group">
                                                <input type="text" name="middlename" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Last Name</label>
                                            <div class="form-group">
                                                <input type="text" name="lastname" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Birthday</label>
                                            <div class="form-group">
                                                <input type="date" id="birthday" name="birthday"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Age</label>
                                            <div class="form-group">
                                                <input type="number" id="age" name="age" class="form-control"
                                                    style="background-color: rgb(202, 197, 197)" required readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Sex</label>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sex" id="female" value="female">
                                                    <label class="form-check-label" for="female">
                                                        Female
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sex" id="male" value="male">
                                                    <label class="form-check-label" for="male">
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Contact Number</label>
                                            <div class="form-group">
                                                <input type="text" name="contact_number" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Occupation</label>
                                            <div class="form-group">
                                                <input type="text" name="occupation" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Address</label>
                                            <div class="form-group">
                                                <input type="text" name="address" class="form-control" required>
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
    <script>
        $(document).ready(function() {
            $('.modal .close').click(function() {
                $(this).closest('.modal').modal('hide');
            });
        });

        document.getElementById('birthday').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var monthDiff = today.getMonth() - dob.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            document.getElementById('age').value = age;
        });

        document.getElementById('edit_birthday').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var monthDiff = today.getMonth() - dob.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            document.getElementById('edit_age').value = age;
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
