@extends('layouts.sidebar')
@section('title', 'Services')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Services</h4>

                    </div>
                </div>

            </div>
            <!-- row -->


            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal"
                                data-bs-target="#addUserModal"> ADD SERVICE
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            
                                            <th>NAME</th>
                                            <th>PRICE</th>
                                            <th>DESCRIPTION</th>
                                            <th>STATUS</th>
                                            <th>IMAGE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($services as $service)
                                            <tr>
                                             
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->price }}</td>
                                                <td>{{ $service->description }}</td>
                                                <td>
                                                    @if ($service->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <img src="{{ asset('service_image/' . $service->image) }}"
                                                        alt="QR Code" style="max-width: 100px;">

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
                                                                action="{{ route('update-service-status', ['id' => $service->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status"
                                                                    value="{{ $service->status == 1 ? 0 : 1 }}">
                                                                <button type="submit" class="dropdown-item"
                                                                    style="text-decoration: none;">
                                                                    @if ($service->status == 1)
                                                                        <span class="">Active</span>
                                                                    @else
                                                                        <span class="">Inactive</span>
                                                                    @endif
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('service.destroy', $service->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="deleteForm{{ $service->id }}">
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
                                <h3 class="text-center">Service Information</h3>
                                <button type="button" id="close" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="multiStepForm" method="POST" action="{{ route('service.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Service Name</label>
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>
                                                <label>Price</label>
                                                <div class="form-group">
                                                    <input type="number" name="price" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label> Short Description</label>
                                                    <textarea class="form-control" name="description" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control" required>
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
            const statusCells = document.querySelectorAll('.service-status');

            statusCells.forEach(cell => {
                cell.addEventListener('click', function() {
                    const serviceId = this.getAttribute('data-service-id');
                    const newStatus = this.textContent.trim() === 'Active' ? 0 : 1;

                    // Send AJAX request to update status
                    fetch(`/update-service-status/${serviceId}`, {
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
