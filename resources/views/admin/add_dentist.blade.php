@extends('layouts.sidebar')
@section('title', 'Dentists')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Dentist</h4>

                    </div>
                </div>

            </div>
            <!-- row -->


            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal"
                                data-bs-target="#addUserModal"> ADD DENTIST
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                           
                                            <th>IMAGE</th>
                                            <th>USER ID</th>
                                            <th>NAME</th>
                                            <th>CONTACT NUMBER</th>
                                            <th>ADDRESS</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dentists as $dentist)
                                            <tr>
                                              
                                                <td>
                                                    <img src="{{ asset('dentist_image/' . $dentist->image) }}"
                                                        alt="QR Code" style="max-width: 100px;">

                                                </td>
                                                <td>{{ $dentist->user_id }}</td>
                                                <td>Dr. {{ $dentist->firstname }} {{ $dentist->lastname }}</td>
                                                <td>{{ $dentist->contact_number }}</td>
                                                <td>{{ $dentist->address }}</td>
                                                <td>
                                                    @if ($dentist->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
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
                                                            <form method="POST"
                                                                action="{{ route('update-dentist-status', ['id' => $dentist->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status"
                                                                    value="{{ $dentist->status == 1 ? 0 : 1 }}">
                                                                <button type="submit" class="dropdown-item"
                                                                    style="text-decoration: none;">
                                                                    @if ($dentist->status == 1)
                                                                        <span class="">Active</span>
                                                                    @else
                                                                        <span class="">Inactive</span>
                                                                    @endif
                                                                </button>
                                                            </form>
                                                            <!--
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editUserModal{{ $dentist->id }}">
                                                                <i class="dw dw-edit2"></i>Edit
                                                            </button>
                                                            -->
                                                            <form action="{{ route('dentist.destroy', $dentist->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="deleteForm{{ $dentist->id }}">
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
                                        @empty
                                            <tr>
                                                <td colspan="10" style="text-align: center">No data available</td>
                                            </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                          
                                @if($dentists->isEmpty())
                                <tr>
                                    <td colspan="10" style="text-align: center">No data available</td>
                                </tr>
                            @else

                                <div class="modal fade" id="editUserModal{{ $dentist->id }}" tabindex="-1"
                                    aria-labelledby="editUserModalLabel{{ $dentist->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="text-center">Dentist Information</h3>
                                                <button type="button" id="close" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body  modal-lg">
                                                <form id="multiStepForm" method="POST"
                                                    action="{{ route('dentist.update', $dentist->id) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div id="step1">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>First Name</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="firstname"
                                                                        class="form-control"  value="{{ $dentist->firstname }}" required>
                                                                </div>
                                                                <label>Middle Name</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="middlename"
                                                                    value="{{ $dentist->middlename }}"   class="form-control">
                                                                </div>
                                                                <label>Last Name</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="lastname"
                                                                        class="form-control"  value="{{ $dentist->lastname }}" required>
                                                                </div>
                                                                <label>Username</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="lastname"
                                                                        class="form-control"  value="{{ $dentist->username }}" required>
                                                                </div>
                                                                <label>Contact Number</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="contact_number"
                                                                        class="form-control"  value="{{ $dentist->contact_number }}" required>
                                                                </div>
                                                                <label>Current Image</label>
                                                                <div class="form-group">
                                                                    <img src="{{ asset('dentist_image/' . $dentist->image) }}"
                                                                        class="existing-image" width="100" height="100"
                                                                        alt="Current Image">
                                                                </div>
                                                            </div>
                                                        


                                                            <div class="col-md-6">
                                                                <label>Address</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="address"
                                                                        class="form-control" value="{{ $dentist->contact_number }}" required>
                                                                </div>
                                                                <label>About</label>
                                                                <div class="form-group">
                                                                    <input type="text" name="about"
                                                                        class="form-control" value="{{ $dentist->about }}" required>
                                                                </div>
                                                                <label>Email</label>
                                                                <div class="form-group">
                                                                    <input type="email" name="email"
                                                                        class="form-control" value="{{ $dentist->email }}" required >
                                                                </div>
                                                                <label>Password</label>
                                                                <div class="form-group">
                                                                    <input type="password" name="password"
                                                                        class="form-control" value="{{ $dentist->password }}" required>
                                                                </div>

                                                              
                                                                    <label>Upload New Image</label>
                                                                    <div class="form-group">
                                                                        <input type="file" name="image" class="form-control">
                                                                    </div>
                                                            

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

                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-center">Dentist Information</h3>
                                <button type="button" id="close" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body  modal-lg">
                                <form id="multiStepForm" method="POST" action="{{ route('dentist.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>First Name</label>
                                                <div class="form-group">
                                                    <input type="text" name="firstname" class="form-control" required>
                                                </div>
                                                <label>Middle Name</label>
                                                <div class="form-group">
                                                    <input type="text" name="middlename" class="form-control">
                                                </div>
                                                <label>Last Name</label>
                                                <div class="form-group">
                                                    <input type="text" name="lastname" class="form-control">
                                                </div>
                                                <label>Username</label>
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-control">
                                                </div>
                                                <label>Contact Number</label>
                                                <div class="form-group">
                                                    <input type="text" name="contact_number" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Address</label>
                                                <div class="form-group">
                                                    <input type="text" name="address" class="form-control">
                                                </div>
                                                <label>About</label>
                                                <div class="form-group">
                                                    <input type="text" name="about" class="form-control">
                                                </div>
                                                <label>Email</label>
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control">
                                                </div>
                                                <label>Password</label>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-control">
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
    <script>
        $(document).ready(function() {
            $('#addUserModal .close').click(function() {
                $('#addUserModal').modal('hide');
            });
            $('.modal .close').click(function() {
                $(this).closest('.modal').modal('hide');
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const statusCells = document.querySelectorAll('.dentist-status');

            statusCells.forEach(cell => {
                cell.addEventListener('click', function() {
                    const dentistId = this.getAttribute('data-dentist-id');
                    const newStatus = this.textContent.trim() === 'Active' ? 0 : 1;

                    // Send AJAX request to update status
                    fetch(`/update-dentist-status/${dentistId}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Failed to update status');
                        })
                        .then(data => {
                            // Update UI based on response
                            const badge = data.status === 1 ?
                                '<span class="badge badge-success">Active</span>' :
                                '<span class="badge badge-danger">Inactive</span>';
                            this.innerHTML = badge;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
