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

            <!-- Patient DataTable View -->
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
                            <div class="table-responsive">
                                <table id="patientsTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            <tr>
                                                <td style="text-transform: uppercase;">
                                                    {{ $patient->firstname }} {{ $patient->lastname }}
                                                </td>
                                                <td>{{ $patient->username ?? 'N/A' }}</td>
                                                <td>{{ $patient->number }}</td>
                                                <td>{{ $patient->address }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewModal{{ $patient->id }}" title="View">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $patient->id }}" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                            onclick="confirmDelete({{ $patient->id }})" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <form id="deleteForm{{ $patient->id }}"
                                                        action="{{ route('patients.destroy', $patient->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Include modals for each patient -->
                                            @include('modal.view_patient', ['patient' => $patient])
                                            @include('modal.edit_patient', ['patient' => $patient])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modal.add_patient', ['patient' => $patient])

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#patientsTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "lengthChange": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "Search patients:",
                    "lengthMenu": "Show _MENU_ patients per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ patients",
                    "infoEmpty": "No patients available",
                    "infoFiltered": "(filtered from _MAX_ total patients)",
                    "zeroRecords": "No matching patients found"
                },
                "columnDefs": [{
                        "orderable": false,
                        "targets": 4
                    } // Disable sorting on Actions column
                ]
            });

            // Close modal handler
            $('#close').click(function() {
                $(this).closest('.modal').modal('hide');
            });
        });

        // Delete confirmation function
        function confirmDelete(patientId) {
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
