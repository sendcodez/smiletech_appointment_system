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
    <div class="d-flex justify-content-between mb-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('faq.patient') }}" class="form-inline w-50">
            <div class="form-group w-100">
                <input type="text" name="search" class="form-control w-100" placeholder="Search FAQs..." value="{{ request('search') }}">
            </div>
        </form>
    
        <!-- Category Filter -->
        <form method="GET" action="{{ route('faq.patient') }}" class="form-inline w-50">
            <div class="form-group w-100">
                <select name="category" class="form-control w-100" onchange="this.form.submit()">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    

    @if($faqs->isEmpty())
        <p>No FAQs found for your search query.</p>
    @else
        <div id="accordion">
            @foreach($faqs as $index => $faq)
                <div class="card">
                    <div class="card-header" style="background-color: #FAD5A5;">
                        <button class="btn btn-block {{ $index === 0 ? '' : 'collapsed' }}" style="font-size: 1.4rem;" data-toggle="collapse" data-target="#faq{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </div>
                    <div id="faq{{ $faq->id }}" class="collapse {{ $index === 0 ? 'show' : '' }}" data-parent="#accordion">
                        <div class="card-body" style="font-size: 1.2rem;">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


@endsection
