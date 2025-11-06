<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Smiletech</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('frontend/img/smiletech_logo.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css ') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/lib/twentytwenty/twentytwenty.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
</head>
<style>
    .service-image {
        width: 100%; /* Set the width to 100% to make all images the same width */
        height: 300px; /* Set a fixed height to maintain aspect ratio */
        object-fit: cover; /* Ensure the image covers the entire container */
    }
</style>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"><i class="far fa-clock text-secondary me-2"></i>Opening Hours: {{ date('h:i A', strtotime($website->store_hour_start)) }} - {{ date('h:i A', strtotime($website->store_hour_end)) }}
                    </small>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end ">
                <div class="position-relative d-inline-flex align-items-center bg-secondary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2 ">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i>{{$website->email}}</p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i>{{$website->contact_number}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="{{ route ('index') }}" class="navbar-brand p-0">
            <h1 class="m-2" style="color:#ff7400" > <img class="me-2" style="width:20%;" src="{{ asset('frontend/img/smiletech_logo.png') }}" alt="Image">{{ strtoupper($website->business_name) }}
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route ('index') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route ('about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route ('services') }}" class="nav-item nav-link">Services</a>
                <a href="{{ route ('dentist') }}" class="nav-item nav-link active">Dentists</a>
                <a href="{{ route ('faq_public') }}" class="nav-item nav-link">FAQ</a>
            </div>
            <a href="{{ route ('login') }}" class="btn btn-secondary py-2 px-4 ms-3">Appointment</a>
        </div>
    </nav>
    <!-- Navbar End -->




   <!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                <div class="section-title bg-light rounded h-100 p-5">
                    <h5 class="position-relative d-inline-block text-secondary text-uppercase">Our Dentist</h5>
                    <h1 class="display-6 mb-4">Meet Our Certified & Experienced Dentist</h1>
                    <a href="{{ route ('login') }}" class="btn btn-secondary py-3 px-5">Appointment</a>
                </div>
            </div>
            @foreach($dentists as $dentist)
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="position-relative rounded-top" style="z-index: 1;">
                        <img class="img-fluid rounded-top w-100" src="{{ asset('dentist_image/' . $dentist->image) }}" alt="{{ $dentist->firstname }}">

                    </div>
                    <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                        <h4 class="mb-2">{{ $dentist->firstname }} {{ $dentist->lastname }}</h4>
                        <p class="text-secondary mb-0">{{ $dentist->about }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Team End -->



    <div class="container-fluid text-light py-4" style="background: #051225;">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-12 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white border-bottom" href="#">Smiletech</a>. All Rights Reserved.</p>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer End -->




    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/wow/wow.min.js ') }}"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/twentytwenty/jquery.event.move.js') }}"></script>
    <script src="{{ asset('frontend/lib/twentytwenty/jquery.twentytwenty.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
