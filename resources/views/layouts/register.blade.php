<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/smile_tech.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css ') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/lib/twentytwenty/twentytwenty.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
</head>

<body class="h-100">
    <!-- Topbar Start -->
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"><i class="far fa-clock text-secondary me-2"></i>Opening Hours:
                        {{ date('h:i A', strtotime($website->store_hour_start)) }} -
                        {{ date('h:i A', strtotime($website->store_hour_end)) }}
                    </small>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end ">
                <div class="position-relative d-inline-flex align-items-center bg-secondary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2 ">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i>{{ $website->email }}</p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i>{{ $website->contact_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="index.html" class="navbar-brand p-0">
            <h1 class="m-2" style="color:#ff7400"> <img class="me-2" style="width:20%;"
                    src="{{ asset('frontend/img/smiletech_logo.png') }}"
                    alt="Image">{{ strtoupper($website->business_name) }}
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('index') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('services') }}" class="nav-item nav-link">Services</a>
                <a href="{{ route('dentist') }}" class="nav-item nav-link">Dentists</a>
                <a href="{{ route('faq_public') }}" class="nav-item nav-link">FAQ</a>
            </div>
            <a href="{{ route('login') }}" class="btn btn-secondary py-2 px-4 ms-3">Appointment</a>
        </div>
    </nav>
    <!-- Navbar End -->
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-12">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h2 class="text-center mb-4">Sign up your account</h2>
                                    <h4 class="mb-4">PERSONAL INFO</h4>
                                    <form method="POST" action="{{ route('register') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @yield('firstname')
                                                </div>
                                                <div class="form-group">
                                                    @yield('username')
                                                </div>
                                                <div class="form-group">
                                                    @yield('email')
                                                </div>
                                                <div class="form-group">
                                                    @yield('birthday')
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @yield('middlename')
                                                </div>
                                                <div class="form-group">
                                                    @yield('password')
                                                </div>
                                                <div class="form-group">
                                                    @yield('address')
                                                </div>
                                                <div class="form-group">
                                                    @yield('contact_person')
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @yield('lastname')
                                                </div>
                                                <div class="form-group">
                                                    @yield('confirm_password')
                                                </div>
                                                <div class="form-group">
                                                    @yield('contact')
                                                </div>
                                                <div class="form-group">
                                                    @yield('contact_person_number')
                                                </div>
                                            </div>

                                            <!-- MEDICAL HISTORY -->
                                            <h4 class="mb-4">MEDICAL HISTORY</h4>

                                            <div class="row">
                                                <!-- YES/NO FIELD -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label d-block">Do you normally require
                                                            antibiotic cover before dental treatment?</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="antibiotic" id="antibioticYes" value="yes"
                                                            required>
                                                        <label class="form-check-label"
                                                            for="antibioticYes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="antibiotic" id="antibioticNo" value="no"
                                                            required>
                                                        <label class="form-check-label" for="antibioticNo">No</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label d-block">Have you had any abnormal
                                                            reactions to local or general anaesthesia?</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="anaesthesia" id="anaesthesiaYes" value="yes"
                                                            required>
                                                        <label class="form-check-label"
                                                            for="anaesthesiaYes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="anaesthesia" id="anaesthesiaNo" value="no"
                                                            required>
                                                        <label class="form-check-label" for="anaesthesiaNo">No</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label d-block">Do you
                                                            smoke?</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="smoke"
                                                            id="smokeYes" value="yes" required>
                                                        <label class="form-check-label" for="smokeYes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="smoke"
                                                            id="smokeNo" value="no" required>
                                                        <label class="form-check-label" for="smokeNo">No</label>
                                                    </div>
                                                </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label d-block">Are you
                                                        pregnant?</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="smoke"
                                                        id="smokeYes" value="yes" required>
                                                    <label class="form-check-label" for="smokeYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="smoke"
                                                        id="smokeNo" value="no" required>
                                                    <label class="form-check-label" for="smokeNo">No</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label d-block">Are you being treated by a
                                                        doctor at present?</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="doctor"
                                                        id="doctorYes" value="yes" required>
                                                    <label class="form-check-label" for="doctorYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="doctor"
                                                        id="doctorNo" value="no" required>
                                                    <label class="form-check-label" for="doctorNo">No</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label d-block">Are you taking any
                                                        prescription or other medications at present?</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="prescription" id="prescriptionYes" value="yes"
                                                        required>
                                                    <label class="form-check-label" for="prescriptionYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="prescription" id="prescriptionNo" value="no"
                                                        required>
                                                    <label class="form-check-label" for="prescriptionNo">No</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label d-block">Have you been hospitalized in
                                                        the last 12 months?</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="hospitalized" id="hospitalizedYes" value="yes"
                                                        required>
                                                    <label class="form-check-label" for="hospitalizedYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="hospitalized" id="hospitalizedNo" value="no"
                                                        required>
                                                    <label class="form-check-label" for="hospitalizedNo">No</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="medications">Please list current medications (Comma Seperated) N/A if none</label>
                                                    <input type="text" class="form-control" id="medications" name="medications"
                                                        placeholder="Enter your medications here">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="allergies">Please list any drugs or medicines you are allergic to (Comma Seperated) N/A if none</label>
                                                    <input type="text" class="form-control" id="allergies" name="allergies"
                                                        placeholder="Enter your drug allergies here">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="known_allergies">Please list any other known allergies (including latex, foods and preservatives) (Comma Seperated) N/A if none</label>
                                                    <input type="text" class="form-control" id="known_allergies" name="known_allergies"
                                                        placeholder="Enter your drug knownallergies here">
                                                </div>
                                            </div>
                                        </div>

                                         <!-- MEDICAL CONDITIONS -->
                                        <h4 class="mb-4">DO YOU HAVE NOW, OR HAVE YOU EVER HAD, ANY OF THE FOLLOWING MEDICAL CONDITIONS?</h4>

                                        <div class="row">

                                            <!-- YES/NO FIELD -->
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label d-block">Steriod Therapy</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="steriod" id="steriodYes" value="yes"
                                                            required>
                                                        <label class="form-check-label"
                                                            for="steriodYes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="steriod" id="steriodNo" value="no"
                                                            required>
                                                        <label class="form-check-label" for="steriodNo">No</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label d-block">Kidney Disease</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="kidney" id="kidneyYes" value="yes"
                                                            required>
                                                        <label class="form-check-label"
                                                            for="kidneyYes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="kidney" id="kidneyNo" value="no"
                                                            required>
                                                        <label class="form-check-label" for="kidneyNo">No</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label d-block">Prosthetic implant eg artificial hip</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="prosthetic" id="prostheticYes" value="yes"
                                                            required>
                                                        <label class="form-check-label"
                                                            for="prostheticYes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="prosthetic" id="prostheticNo" value="no"
                                                            required>
                                                        <label class="form-check-label" for="prostheticNo">No</label>
                                                    </div>
                                                </div>


                                        </div>


                                        <div class="form-group">
                                            @yield('terms')

                                        </div>
                                        <div class="form-group">
                                            @yield('privacy')
                                        </div>
                                        <div class="new-account mt-3">
                                            @yield('already')
                                        </div>
                                        <div class="text-center mt-4">
                                            @yield('button')
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="termsModalLabel">Terms and Conditions</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>1. Introduction</h4>
                    <p>Welcome to SmileTech. These Terms and Conditions govern your use of our website and services. By
                        accessing or using our website, you agree to comply with and be bound by these Terms. If you do
                        not
                        agree with these Terms, please do not use our website or services.</p><br>

                    <h4>2. Use of the Website</h4>
                    <li>You agree to use the website only for lawful purposes and in a way that does not infringe the
                        rights
                        of others or restrict their use and enjoyment of the website.</li><br>
                    <li>You are responsible for maintaining the confidentiality of your account and password and for all
                        activities that occur under your account.</li><br>

                    <h4>3. Intellectual Property</h4>
                    <li>All content on the SmileTech website, including text, graphics, logos, images, and software, is
                        the
                        property of SmileTech and is protected by copyright, trademark, and other intellectual property
                        laws.</li><br>
                    <li>You may not reproduce, distribute, modify, or create derivative works of any content on our
                        website
                        without our express written permission.</li><br>

                    <h4>4. User Content</h4>
                    <p>You retain ownership of any content you submit to the website, but you grant SmileTech a
                        non-exclusive, royalty-free, worldwide license to use, display, reproduce, and distribute such
                        content. You agree that any content you submit does not violate any third-party rights and is
                        not
                        unlawful, offensive, or otherwise objectionable.</p><br>

                    <h4>5. Privacy</h4>
                    <p>Your privacy is important to us. Please review our Privacy Policy, which explains how we collect,
                        use, and protect your personal information.</p><br>

                    <h4>6. Limitation of Liability</h4>
                    <li>SmileTech is not liable for any direct, indirect, incidental, consequential, or punitive damages
                        arising from your use of the website or services.</li><br>
                    <li>We do not guarantee that the website will be available at all times or that it will be free from
                        errors, viruses, or other harmful components.</li><br>

                    <h4>7. Changes to the Terms</h4>
                    <p>SmileTech reserves the right to modify these Terms at any time. We will notify you of any changes
                        by
                        posting the new Terms on our website. Your continued use of the website after such changes
                        constitutes your acceptance of the new Terms.</p><br>

                    <h4>8. Governing Law</h4>
                    <p>These Terms are governed by and construed in accordance with the laws of the jurisdiction in
                        which
                        SmileTech operates. Any disputes arising out of or relating to these Terms will be resolved in
                        the
                        courts of that jurisdiction.</p><br>

                    <h4>9. Contact Us</h4>
                    <p>If you have any questions or concerns about these Terms, please contact us at:</p>
                    <li>Email: smiletech@gmail.com</li><br>
                    <li>Phone: 0909-111-2222</li>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="privacyModalLabel">Privacy Policy</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>WE RESPECT YOUR PRIVACY</h4>
                    <p>In order to provide you with the highest standard of dental care, this practice is required to
                        collect personal information from you. This information covers basic details such as your name,
                        address and telephone number but it is also necessary for the dentist to obtain from you details
                        regarding your general health and past medical or surgical events. Without this general health
                        picture, the treating dentist is unable to plan your care properly.</p><br>

                    <li>Naturally, some of this information is of a personal nature and some of it might be regarded as
                        'sensitive' and not the sort of information that you would wish to be unnecessarily disclosed to
                        others.</li><br>

                    <li>We value the need to safeguard this information and, in accordance with the principles laid down
                        in
                        privacy legislation and the guidelines issued by the Australian Dental Association, we would
                        like to
                        assure you that:</li><br>

                    <li>This information will only be used by the treating dentist in order to deliver your care to the
                        highest standards.</li><br>

                    <li>It will not be disclosed to those not associated with your treatment without your consent except
                        as
                        provided under the legislation and where we consider you would have a reasonable expectation of
                        us
                        to provide such information.</li><br>

                    <li>You may seek access to the information held about you and we will provide this access without
                        undue
                        delay. This access might be by inspection of your dental records at the time of appointment or
                        by
                        special access or copying of information at other times.</li><br>

                    <li>There will be no charge made for requesting this information but there may be fees levied just
                        to
                        cover the costs associated with the processing of this request or the copying of information.
                    </li><br>

                    <li>We will take reasonable steps to ensure at all times that the details we keep about you are
                        accurate, complete and up-to-date.</li><br>

                    <li>We will take reasonable steps to protect this information from misuse or loss and from
                        unauthorised
                        access, modification or disclosure.</li><br>

                    <li>If you have any questions regarding the information we collect from you and hold in your dental
                        records, please do not hesitate to ask us. We are acting in your interests at all times.</li>
                    <br>

                    <p>If you have any questions or concerns about these Terms, please contact us at:</p>
                    <li>Email: smiletech@gmail.com</li>
                    <li>Phone: 0909-111-2222</li>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var terms = document.getElementById('termsCheckbox');
            var privacy = document.getElementById('privacyCheckbox');
            var submitButton = document.getElementById('submitButton');

            if (terms && privacy && submitButton) {
                function toggleSubmitButton() {
                    submitButton.disabled = !(terms.checked && privacy.checked);
                }

                terms.addEventListener('change', toggleSubmitButton);
                privacy.addEventListener('change', toggleSubmitButton);
            }
        });
    </script>


    <!--**********************************
 Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/global/global.min.js ') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>
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
