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

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Patient Cards View -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Patient Records</h4>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">
                                <i class="fa fa-plus"></i> ADD PATIENT
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($patients as $patient)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card patient-card h-100 shadow-sm">
                                            <div class="card-body">
                                                <div class="text-center mb-3">
                                                    <!--
                                                                                                                                                                                    <div class="avatar-circle mx-auto mb-3">
                                                                                                                                                                                        <span
                                                                                                                                                                                            class="initials">{{ strtoupper(substr($patient->firstname, 0, 1) . substr($patient->lastname, 0, 1)) }}</span>
                                                                                                                                                                                    </div>
                                                                                                                                                                                -->
                                                    <h5 class="card-title mb-1 bold" style="text-transform: uppercase;">
                                                        {{ $patient->firstname }}
                                                        {{ $patient->lastname }}</h5>
                                                    <p class="text-muted small mb-0">{{ $patient->username ?? 'N/A' }}</p>
                                                </div>

                                                <div class="patient-info">

                                                    <div class="info-item">
                                                        <i class="fa fa-phone text-success"></i>
                                                        <span><strong>Contact:</strong> {{ $patient->number }}</span>
                                                    </div>
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker text-danger"></i>
                                                        <span><strong>Address:</strong>
                                                            {{ Str::limit($patient->address, 30) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-light">
                                                <div class="btn-group w-100" role="group">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewModal{{ $patient->id }}">
                                                        <i class="fa fa-eye"></i> View
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $patient->id }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                        onclick="confirmDelete({{ $patient->id }})">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                                <form id="deleteForm{{ $patient->id }}"
                                                    action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Include modals for each patient -->
                                    @include('modal.view_patient', ['patient' => $patient])
                                    @include('modal.edit_patient', ['patient' => $patient])

                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center">
                                            <i class="fa fa-info-circle fa-3x mb-3"></i>
                                            <h4>No Patients Found</h4>
                                            <p>Start by adding your first patient record.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Patient Modal (keep your existing add modal) -->
            <!-- ... existing add modal code ... -->
        </div>
    </div>


    @include('modal.add_patient', ['patient' => $patient])


    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#close').click(function() {
                $(this).closest('.modal').modal('hide');
            });
        });

        // Delete confirmation function
        function confirmDelete(patientId) {
            // Using SweetAlert2 if available
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm' + patientId).submit();
                    }
                });
            } else {
                // Fallback to native confirm
                if (confirm('Are you sure you want to delete this patient? This action cannot be undone.')) {
                    document.getElementById('deleteForm' + patientId).submit();
                }
            }
        }
        // Form validation
        document.getElementById('addPatientForm').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
        });
    </script>
@endsection
