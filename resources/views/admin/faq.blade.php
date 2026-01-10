@extends('layouts.sidebar')
@section('title', 'FAQ')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <!-- Breadcrumb Navigation -->
            <div class="row page-titles mx-0">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('faq.categories') }}">Categories</a>
                            </li>

                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>FAQ</h4>
                    </div>
                </div>
            </div>
            <!-- row -->

            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal"
                                data-bs-target="#addUserModal"> ADD FAQ
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>CATEGORY</th>
                                            <th>QUESTION</th>
                                            <th>ANSWER</th>
                                            <th>STATUS</th>
                                            <th>ADDED AT</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $faq)
                                            <tr>
                                                <td>{{ $faq->category->name ?? 'N/A' }}</td>
                                                <td>{{ $faq->question }}</td>
                                                <td>{{ $faq->answer }}</td>
                                                <td>
                                                    @if ($faq->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $faq->created_at->format('Y-m-d H:i:s') }}</td>
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
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <!-- Status Toggle -->
                                                                <form method="POST"
                                                                    action="{{ route('update-faq-status', ['id' => $faq->id]) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status"
                                                                        value="{{ $faq->status == 1 ? 0 : 1 }}">
                                                                    <button type="submit" class="dropdown-item status-btn"
                                                                        style="text-decoration: none;">
                                                                        @if ($faq->status == 1)
                                                                            <i class="dw dw-close"></i> Disapprove
                                                                        @else
                                                                            <i class="dw dw-checkmark"></i> Approve
                                                                        @endif
                                                                    </button>
                                                                </form>

                                                                <!-- Edit Button -->
                                                                <button type="button" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editFaqModal{{ $faq->id }}">
                                                                    <i class="dw dw-edit2"></i> Edit
                                                                </button>

                                                                <!-- Delete Button -->
                                                                <form action="{{ route('faq.destroy', $faq->id) }}"
                                                                    method="POST" style="display: inline;"
                                                                    id="deleteForm{{ $faq->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="dropdown-item delete-btn">
                                                                        <i class="dw dw-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Edit Modals -->
                @foreach ($faqs as $faq)
                    <div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1"
                        aria-labelledby="editFaqModalLabel{{ $faq->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="text-center">Edit FAQ</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('faq.update', $faq->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Category</label>
                                                <div class="form-group">
                                                    <select name="faq_category_id" class="form-control" required>
                                                        <option value="">Select a Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $faq->faq_category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Question</label>
                                                    <textarea class="form-control" name="question" style="height: 150px;" required>{{ $faq->question }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Answer</label>
                                                    <textarea class="form-control" name="answer" style="height: 150px;" required>{{ $faq->answer }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <span>Cancel</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Update</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-center">ADD FAQ</h3>
                                <button type="button" id="close" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="multiStepForm" method="POST" action="{{ route('faq.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div id="step1">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Category</label>
                                                <div class="form-group">
                                                    <select name="faq_category_id" class="form-control" required>
                                                        <option value="">Select a Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Question</label>
                                                    <textarea class="form-control" name="question" style="height: 150px;" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Answer</label>
                                                    <textarea class="form-control" name="answer" style="height: 150px;" required></textarea>
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
            const statusCells = document.querySelectorAll('.faq-status');
            statusCells.forEach(cell => {
                cell.addEventListener('click', function() {
                    const faqId = this.getAttribute('data-faq-id');
                    const newStatus = this.textContent.trim() === 'Active' ? 0 : 1;

                    // Send AJAX request to update status
                    fetch(`/update-faq-status/${faqId}`, {
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

        document.querySelectorAll('.status-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission behavior

                const form = this.closest('form'); // Find the closest form element

                // Display SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes'
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
