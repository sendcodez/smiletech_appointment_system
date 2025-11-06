<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/img/smiletech_logo.png') }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.date.css') }}">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>


</head>

<body>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">


        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img style="width:30%" src="{{ asset('frontend/img/smiletech_logo.png') }}" alt="">
                <h1 class="brand-title"> SMILETECH </h1>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->


        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link dz-fullscreen primary" href="#">
                                    <svg id="Capa_1" enable-background="new 0 0 482.239 482.239" height="22"
                                        viewBox="0 0 482.239 482.239" width="22" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m0 17.223v120.56h34.446v-103.337h103.337v-34.446h-120.56c-9.52 0-17.223 7.703-17.223 17.223z"
                                            fill="" />
                                        <path
                                            d="m465.016 0h-120.56v34.446h103.337v103.337h34.446v-120.56c0-9.52-7.703-17.223-17.223-17.223z"
                                            fill="" />
                                        <path
                                            d="m447.793 447.793h-103.337v34.446h120.56c9.52 0 17.223-7.703 17.223-17.223v-120.56h-34.446z"
                                            fill="" />
                                        <path
                                            d="m34.446 344.456h-34.446v120.56c0 9.52 7.703 17.223 17.223 17.223h120.56v-34.446h-103.337z"
                                            fill="" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        <span>Hello, <strong>{{ Auth::user()->firstname }}</strong></span>
                                    </div>
                                    <img src="{{ asset('images/avatar.png') }}" width="20" alt="" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                            class="dropdown-item ai-icon">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                                width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12">
                                                </line>
                                            </svg>
                                            <span class="ml-2">{{ __('Log Out') }}</span>
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    @if (Auth::user()->usertype == '1')
                        <li><a href="{{ route('admin.dashboard') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-networking"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                                <i class="flaticon-381-calendar"></i>
                                <span class="nav-text">Appointments</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('status.pending') }}">Pending</a></li>
                                <li><a href="{{ route('status.approved') }}">Approved</a></li>
                                <li><a href="{{ route('status.completed') }}">Completed</a></li>
                                <li><a href="{{ route('status.cancelled') }}">Cancelled</a></li>
                            </ul>
                        </li>


                        <li><a href="{{ route('dentist.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-stethoscope"></i>
                                <span class="nav-text">Dentist</span>
                            </a>
                        </li>
                        <li><a href="{{ route('patients.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-users"></i>
                                <span class="nav-text">Patients</span>
                            </a>
                        </li>
                        <!-- <li><a href="widget-basic.html" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-files-o"></i>
                                <span class="nav-text">Records</span>
                            </a>
                        </li> -->
                        <li><a href="{{ route('reports.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-file-o"></i>
                                <span class="nav-text">Reports</span>
                            </a>
                        </li>
                        <li><a href="{{ route('service.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-list-alt"></i>
                                <span class="nav-text">Services</span>
                            </a>
                        </li>

                        <div class="sidebar-small-cap">
                            <h4>Others</h4>
                        </div>

                        <li><a href="{{ route('activity.show') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-clock"></i>
                                <span class="nav-text">Activity Log</span>
                            </a>
                        </li>
                        <!--<li><a href="{{ route('customer-support') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-comments-o"></i>
                                <span class="nav-text">Customer Support</span>
                            </a>
                        </li>
                    -->
                        <li><a href="{{ route('faq.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-question-circle-o"></i>
                                <span class="nav-text">FAQ</span>
                            </a>
                        </li>
                        <li><a href="{{ route('user.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-user-plus"></i>
                                <span class="nav-text">Manage Users</span>
                            </a>
                        </li>
                        <li><a href="{{ route('website.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-globe"></i>
                                <span class="nav-text">Manage Website</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->usertype == '3')
                        <li><a href="{{ route('appointment.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-calendar"></i>
                                <span class="nav-text">Appointments</span>
                            </a>
                        </li>
                        <li><a href="{{ route('results.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-file"></i>
                                <span class="nav-text">Records</span>
                            </a>
                        </li>
                        <!-- <li><a href="{{ route('customer-support') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-comments-o"></i>
                                <span class="nav-text">Customer Support</span>
                            </a>
                        </li>
                    -->
                        <li><a href="{{ route('faq.patient') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-question-circle-o"></i>
                                <span class="nav-text">FAQ</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->usertype == '2')
                        <li><a href="{{ route('dentist_app.index') }}" class="ai-icon" aria-expanded="false">
                                <i class="fa fa-users"></i>
                                <span class="nav-text">Patients</span>
                            </a>
                        </li>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
          CONTENT
        ***********************************-->
        @yield ('contents')


    </div>



    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>


    <!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>

</body>

</html>
