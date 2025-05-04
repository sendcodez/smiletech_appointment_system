@extends('layouts.sidebar')
@section('title', 'Manage users')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manage Users</h4>

                    </div>
                </div>

            </div>
            <!-- row -->


            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal"
                                data-bs-target="#addUserModal"> ADD USER
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>STATUS</th>
                                            <th>USER TYPE</th>
                                            <th>DATE ADDED</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td> @if ($user->usertype == 1)
                                                    <span class="">Admin</span>
                                                    @elseif ($user->usertype == 2)
                                                    <span class="">Dentist</span>
                                                    @else ($user->usertype == 3)
                                                    <span class="">Patient</span>
                                                   
                                                @endif</td>
                                                <td>
                                                    @if($user->created_at)
                                                        {{ $user->created_at->toDateString() }}
                                                    @else
                                                    2024-05-08
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
                                                                action="{{ route('update-user-status', ['id' => $user->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status"
                                                                    value="{{ $user->status == 1 ? 0 : 1 }}">
                                                                <button type="submit" class="dropdown-item"
                                                                    style="text-decoration: none;">
                                                                    @if ($user->status == 1)
                                                                        <span class="">Active</span>
                                                                    @else
                                                                        <span class="">Inactive</span>
                                                                    @endif
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('user.destroy', $user->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="deleteForm{{ $user->id }}">
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
                                <h3 class="text-center">User Information</h3>
                                <button type="button" id="close" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="multiStepForm" method="POST" action="{{ route('user.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1">

                                        <div class="row">
                                            <div class="col-md-12">
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
                                                    <input type="text" name="lastname" class="form-control" required>
                                                </div>
                                                <label>Email</label>
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control">
                                                </div>
                                                <label>Username</label>
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-control">
                                                </div>
                                                <label>Password</label>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-control" required>
                                                </div>
                                                <label>User type</label>
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label><input type="radio" name="usertype" value="1"> Admin</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="usertype" value="2"> Dentist</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="usertype" value="3"> Patient</label>
                                                    </div>
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
            const statusCells = document.querySelectorAll('.user-status');

            statusCells.forEach(cell => {
                cell.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const newStatus = this.textContent.trim() === 'Active' ? 0 : 1;

                    // Send AJAX request to update status
                    fetch(`/update-user-status/${userId}`, {
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
