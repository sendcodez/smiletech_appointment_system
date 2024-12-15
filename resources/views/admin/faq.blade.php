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
                                    <a href="{{route('faq.categories')}}">Categories</a>
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
                                            <th>ADDED AT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $faq)
                                        <tr>
                                            <td>{{ $faq->category->name ?? 'N/A' }}</td>
                                            <td>{{ $faq->question }}</td>
                                            <td>{{ $faq->answer }}</td>
                                            <td>{{ $faq->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                        @endforeach
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
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
