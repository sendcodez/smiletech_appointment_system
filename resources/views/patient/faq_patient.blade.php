@extends('layouts.sidebar')

@section('contents')
    <style>
        .faq-wrap {
            margin-top: 150px;
            text-align: center;
            width: 70%;
            margin-left: 23.5%;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f9fa;
        }

        .card-body {
            font-size: 0.9rem;
            line-height: 1.6;
        }
    </style>

    <div class="faq-wrap">
        <h2 class="mb-20 h2 text-blue">Frequently Asked Questions</h2>
        <!-- Search Bar and Category Filter (flex layout) -->
        <div class="card-header">
            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#addUserModal">
                ADD QUESTION
            </button>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <!-- Search Bar -->
            <form method="GET" action="{{ route('faq.patient') }}" class="form-inline w-50">
                <div class="form-group w-100">
                    <input type="text" name="search" class="form-control w-100" placeholder="Search FAQs..."
                        value="{{ request('search') }}">
                </div>
            </form>

            <!-- Category Filter -->
            <form method="GET" action="{{ route('faq.patient') }}" class="form-inline w-50">
                <div class="form-group w-100">
                    <select name="category" class="form-control w-100" onchange="this.form.submit()">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>


        @if ($faqs->isEmpty())
            <p>No FAQs found for your search query.</p>
        @else
            <div id="accordion">
                @foreach ($faqs as $index => $faq)
                    <div class="card">
                        <div class="card-header" style="background-color: #d87148;">
                            <button class="btn btn-block {{ $index === 0 ? '' : 'collapsed' }}"
                                style="font-size: 1.4rem; color:aliceblue" data-toggle="collapse"
                                data-target="#faq{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </div>
                        <div id="faq{{ $faq->id }}" class="collapse {{ $index === 0 ? 'show' : '' }}"
                            data-parent="#accordion">
                            <div class="card-body" style="font-size: 1.2rem;">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center">ADD QUESTION</h3>
                    <button type="button" id="close" class="close" data-bs-dismiss="modal" aria-label="Close">
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
    <script>
        $(document).ready(function() {
            $('#addUserModal .close').click(function() {
                $('#addUserModal').modal('hide');
            });
            $('.modal .close').click(function() {
                $(this).closest('.modal').modal('hide');
            });
        });
    </script>
@endsection
