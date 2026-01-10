@extends('layouts.sidebar')
@section('title', 'FAQ Categories')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <!-- Breadcrumb Navigation -->
            <div class="row page-titles mx-0">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"> <a href="{{ route('faq.index') }}">FAQ</a></li>
                            <li class="breadcrumb-item active">
                                Categories
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
                                data-bs-target="#addUserModal"> ADD FAQ CATEGORY
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ADDED AT</th>
                                            <th class="text-center">CATEGORY NAME</th>
                                            <th class="text-center">NUMBER OF QUESTIONS</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="text-center">{{ $category->created_at->format('Y-m-d') }}</td>
                                                <td class="text-center">{{ $category->name }}</td>
                                                <td class="text-center">{{ $category->faqs_count }}</td>
                                                <td class="text-center">
                                                    <div class="dropdown ml-auto text-center">
                                                        <div class="btn-link" data-toggle="dropdown">
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
                                                            <!-- Edit Button -->
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editCategoryModal{{ $category->id }}">
                                                                <i class="dw dw-edit2"></i> Edit
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <form
                                                                action="{{ route('faq_categories.destroy', $category->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="deleteForm{{ $category->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item delete-btn">
                                                                    <i class="dw dw-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
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
            </div>

            <!-- Edit Modals -->
            @foreach ($categories as $category)
                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                    aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-center">Edit Category</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('faq_categories.update', $category->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Category Name</label>
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $category->name }}" required>
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
                            <h3 class="text-center">CATEGORY</h3>
                            <button type="button" id="close" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="multiStepForm" method="POST" action="{{ route('faq_categories.store') }}"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Category Name</label>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" required>
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
