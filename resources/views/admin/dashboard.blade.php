@extends('layouts.sidebar')
@section('contents')
    @if (Auth::user()->usertype == '1')
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex mb-3 align-items-start">
                    <div class="mr-auto d-none d-lg-block">
                        <h2 class="text-black font-w600 mb-0">Dashboard</h2>
                    </div>

                    <div class="dropdown custom-dropdown">

                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="widget-stat card" style="cursor: pointer;" data-toggle="modal"
                            data-target="#completedModal">
                            <div class="card-body p-4">
                                <div class="media ai-icon">
                                    <span class="mr-3 bgl-primary text-primary">
                                        <i class="ti-check"></i>
                                    </span>
                                    <div class="media-body">
                                        <h3 class="mb-0 text-black"><span
                                                class="counter ml-0">{{ $completedAppointments }}</span></h3>
                                        <p class="mb-0">Completed Appointments</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="widget-stat card" style="cursor: pointer;" data-toggle="modal"
                            data-target="#totalModal">
                            <div class="card-body p-4">
                                <div class="media ai-icon">
                                    <span class="mr-3 bgl-primary text-primary">
                                        <svg width="32" height="31" viewBox="0 0 32 31" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4 30.5H22.75C23.7442 30.4989 24.6974 30.1035 25.4004 29.4004C26.1035 28.6974 26.4989 27.7442 26.5 26.75V16.75C26.5 16.4185 26.3683 16.1005 26.1339 15.8661C25.8995 15.6317 25.5815 15.5 25.25 15.5C24.9185 15.5 24.6005 15.6317 24.3661 15.8661C24.1317 16.1005 24 16.4185 24 16.75V26.75C23.9997 27.0814 23.8679 27.3992 23.6336 27.6336C23.3992 27.8679 23.0814 27.9997 22.75 28H4C3.66857 27.9997 3.3508 27.8679 3.11645 27.6336C2.88209 27.3992 2.7503 27.0814 2.75 26.75V9.25C2.7503 8.91857 2.88209 8.6008 3.11645 8.36645C3.3508 8.13209 3.66857 8.0003 4 8H15.25C15.5815 8 15.8995 7.8683 16.1339 7.63388C16.3683 7.39946 16.5 7.08152 16.5 6.75C16.5 6.41848 16.3683 6.10054 16.1339 5.86612C15.8995 5.6317 15.5815 5.5 15.25 5.5H4C3.00577 5.50109 2.05258 5.89653 1.34956 6.59956C0.646531 7.30258 0.251092 8.25577 0.25 9.25V26.75C0.251092 27.7442 0.646531 28.6974 1.34956 29.4004C2.05258 30.1035 3.00577 30.4989 4 30.5Z"
                                                fill="#2F4CDD" />
                                            <path
                                                d="M25.25 0.5C24.0139 0.5 22.8055 0.866556 21.7777 1.55331C20.7499 2.24007 19.9488 3.21619 19.4758 4.35823C19.0027 5.50027 18.8789 6.75693 19.1201 7.96931C19.3613 9.1817 19.9565 10.2953 20.8306 11.1694C21.7047 12.0435 22.8183 12.6388 24.0307 12.8799C25.2431 13.1211 26.4997 12.9973 27.6418 12.5242C28.7838 12.0512 29.7599 11.2501 30.4467 10.2223C31.1334 9.19451 31.5 7.98613 31.5 6.75C31.498 5.093 30.8389 3.50442 29.6673 2.33274C28.4956 1.16106 26.907 0.501952 25.25 0.5ZM25.25 10.5C24.5083 10.5 23.7833 10.2801 23.1666 9.86801C22.5499 9.45596 22.0693 8.87029 21.7855 8.18506C21.5016 7.49984 21.4274 6.74584 21.5721 6.01841C21.7167 5.29098 22.0739 4.6228 22.5983 4.09835C23.1228 3.5739 23.791 3.21675 24.5184 3.07206C25.2458 2.92736 25.9998 3.00162 26.6851 3.28545C27.3703 3.56928 27.9559 4.04993 28.368 4.66661C28.7801 5.2833 29 6.00832 29 6.75C28.9989 7.74423 28.6035 8.69742 27.9004 9.40044C27.1974 10.1035 26.2442 10.4989 25.25 10.5Z"
                                                fill="#2F4CDD" />
                                            <path
                                                d="M6.5 13H12.75C13.0815 13 13.3995 12.8683 13.6339 12.6339C13.8683 12.3995 14 12.0815 14 11.75C14 11.4185 13.8683 11.1005 13.6339 10.8661C13.3995 10.6317 13.0815 10.5 12.75 10.5H6.5C6.16848 10.5 5.85054 10.6317 5.61612 10.8661C5.3817 11.1005 5.25 11.4185 5.25 11.75C5.25 12.0815 5.3817 12.3995 5.61612 12.6339C5.85054 12.8683 6.16848 13 6.5 13Z"
                                                fill="#2F4CDD" />
                                            <path
                                                d="M5.25 16.75C5.25 17.0815 5.3817 17.3995 5.61612 17.6339C5.85054 17.8683 6.16848 18 6.5 18H17.75C18.0815 18 18.3995 17.8683 18.6339 17.6339C18.8683 17.3995 19 17.0815 19 16.75C19 16.4185 18.8683 16.1005 18.6339 15.8661C18.3995 15.6317 18.0815 15.5 17.75 15.5H6.5C6.16848 15.5 5.85054 15.6317 5.61612 15.8661C5.3817 16.1005 5.25 16.4185 5.25 16.75Z"
                                                fill="#2F4CDD" />
                                        </svg>
                                    </span>
                                    <div class="media-body">
                                        <h3 class="mb-0 text-black"><span
                                                class="counter ml-0">{{ $totalAppointments }}</span></h3>
                                        <p class="mb-0">Total Appointments</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="widget-stat card" style="cursor: pointer;" data-toggle="modal"
                            data-target="#patientsModal">
                            <div class="card-body p-4">
                                <div class="media ai-icon">
                                    <span class="mr-3 bgl-primary text-primary">
                                        <svg width="32" height="36" viewBox="0 0 32 36" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.25 19.25C12.2389 19.25 13.2056 18.9568 14.0279 18.4074C14.8501 17.8579 15.491 17.0771 15.8694 16.1634C16.2478 15.2498 16.3469 14.2445 16.1539 13.2746C15.961 12.3046 15.4848 11.4137 14.7855 10.7145C14.0863 10.0152 13.1954 9.539 12.2255 9.34608C11.2555 9.15315 10.2502 9.25217 9.33658 9.6306C8.42295 10.009 7.64206 10.6499 7.09265 11.4722C6.54325 12.2944 6.25 13.2611 6.25 14.25C6.25129 15.5757 6.77849 16.8467 7.71589 17.7841C8.65329 18.7215 9.92431 19.2487 11.25 19.25ZM11.25 11.75C11.7445 11.75 12.2278 11.8966 12.6389 12.1713C13.05 12.446 13.3705 12.8365 13.5597 13.2933C13.7489 13.7501 13.7984 14.2528 13.702 14.7377C13.6055 15.2227 13.3674 15.6681 13.0178 16.0178C12.6681 16.3674 12.2227 16.6055 11.7377 16.702C11.2528 16.7984 10.7501 16.7489 10.2933 16.5597C9.83648 16.3705 9.44603 16.0501 9.17133 15.6389C8.89662 15.2278 8.75 14.7445 8.75 14.25C8.75089 13.5872 9.01457 12.9519 9.48322 12.4832C9.95187 12.0146 10.5872 11.7509 11.25 11.75Z"
                                                fill="#2F4CDD" />
                                            <path
                                                d="M30.78 22.4625C31.1927 21.9098 31.4684 21.2672 31.5844 20.5873C31.7005 19.9074 31.6537 19.2096 31.4478 18.5514L30.6543 15.9696C30.2817 14.7451 29.5244 13.6733 28.4946 12.9132C27.4648 12.1531 26.2174 11.7452 24.9375 11.75H19.3287C18.9971 11.75 18.6792 11.8817 18.4448 12.1161C18.2103 12.3505 18.0787 12.6685 18.0787 13C18.0787 13.3315 18.2103 13.6495 18.4448 13.8839C18.6792 14.1183 18.9971 14.25 19.3287 14.25H24.9375C25.6823 14.2474 26.4081 14.485 27.0073 14.9274C27.6064 15.3698 28.0471 15.9935 28.2639 16.706L29.0574 19.2866C29.145 19.5713 29.1645 19.8725 29.1145 20.1661C29.0645 20.4597 28.9463 20.7374 28.7694 20.977C28.5925 21.2166 28.3619 21.4114 28.0961 21.5456C27.8302 21.6799 27.5366 21.7499 27.2388 21.75H15.7777C15.7423 21.75 15.7127 21.7671 15.6777 21.7701C15.5937 21.7669 15.5125 21.75 15.4273 21.75H7.58978C6.20071 21.7449 4.84705 22.1879 3.72972 23.0132C2.61239 23.8385 1.79097 25.0021 1.3874 26.3312L0.454153 29.3625C0.236164 30.0719 0.187639 30.8225 0.31248 31.554C0.43732 32.2856 0.732043 32.9776 1.17296 33.5745C1.61388 34.1715 2.18869 34.6566 2.85119 34.9911C3.51369 35.3255 4.24541 35.4998 4.98753 35.5H18.0287C18.7708 35.4998 19.5026 35.3256 20.1652 34.9912C20.8277 34.6568 21.4026 34.1717 21.8436 33.5747C22.2845 32.9778 22.5793 32.2857 22.7042 31.5541C22.829 30.8226 22.7805 30.0719 22.5625 29.3625L21.6299 26.3315C21.3936 25.5767 21.0217 24.8713 20.5323 24.25H27.2388C27.9283 24.2532 28.6088 24.0928 29.2244 23.7821C29.8399 23.4714 30.3731 23.0191 30.78 22.4625ZM19.8328 32.089C19.6255 32.3726 19.3539 32.6031 19.0403 32.7614C18.7267 32.9198 18.38 33.0015 18.0287 33H4.98753C4.63653 32.9999 4.29043 32.9175 3.97708 32.7594C3.66373 32.6012 3.39187 32.3717 3.18337 32.0894C2.97487 31.807 2.83555 31.4796 2.77661 31.1336C2.71767 30.7876 2.74077 30.4326 2.84403 30.0971L3.77665 27.0661C4.02442 26.2489 4.52925 25.5335 5.21612 25.0261C5.90299 24.5188 6.73523 24.2466 7.58915 24.25H15.4267C16.2806 24.2466 17.1128 24.5188 17.7997 25.0261C18.4865 25.5335 18.9914 26.2489 19.2392 27.0661L20.1718 30.0971C20.2769 30.4323 20.301 30.7877 20.2421 31.134C20.1832 31.4804 20.0429 31.8078 19.8328 32.0894V32.089Z"
                                                fill="#2F4CDD" />
                                            <path
                                                d="M21.875 9.24999C22.7403 9.24999 23.5861 8.9934 24.3056 8.51267C25.0251 8.03194 25.5858 7.34866 25.917 6.54923C26.2481 5.74981 26.3347 4.87014 26.1659 4.02148C25.9971 3.17281 25.5804 2.39326 24.9686 1.78141C24.3567 1.16955 23.5772 0.752876 22.7285 0.584066C21.8798 0.415256 21.0002 0.501896 20.2008 0.833029C19.4013 1.16416 18.7181 1.72492 18.2373 2.44438C17.7566 3.16384 17.5 4.0097 17.5 4.875C17.5014 6.03489 17.9628 7.14688 18.7829 7.96705C19.6031 8.78722 20.7151 9.2486 21.875 9.24999ZM21.875 3C22.2458 3 22.6083 3.10997 22.9167 3.31599C23.225 3.52202 23.4654 3.81485 23.6073 4.15747C23.7492 4.50008 23.7863 4.87708 23.714 5.24079C23.6416 5.6045 23.463 5.9386 23.2008 6.20082C22.9386 6.46304 22.6045 6.64162 22.2408 6.71397C21.8771 6.78631 21.5001 6.74918 21.1575 6.60727C20.8149 6.46535 20.522 6.22503 20.316 5.91669C20.11 5.60835 20 5.24584 20 4.875C20.0006 4.37789 20.1983 3.9013 20.5498 3.54979C20.9013 3.19829 21.3779 3.00056 21.875 3Z"
                                                fill="#2F4CDD" />
                                        </svg>
                                    </span>
                                    <div class="media-body">
                                        <h3 class="mb-0 text-black"><span class="counter ml-0">{{ $totalUsers }}</span>
                                        </h3>
                                        <p class="mb-0">Total Users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                        <div id="user-activity" class="card">
                            <div class="card-header border-0 pb-0 d-sm-flex d-block">
                                <div>
                                    <h4 class="card-title mb-1">Customer Map</h4>
                                    <small class="mb-0">Overview of customer appointment trends</small>
                                </div>
                                <div class="card-action card-tabs mt-3 mt-sm-0">

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="user" role="tabpanel">
                                            <canvas id="appointment" class="chartjs"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h2>Recent Appointments</h2>
                            <table id="example3" class="display" style="min-width: 845px">
                                <div class="col-md-2 col-sm-6">
                                    <div class="form-group">
                                        <label for="statusFilter">Filter by Services:</label>
                                        <select id="statusFilter" class="selectpicker form-control">
                                            <option value="">All</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>PATIENT NAME</th>
                                        <th>SERVICE</th>
                                        <th>TIME</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($appointments as $key => $appointment)
                                        <tr>
                                            <td>{{ $appointment->date }}</td>
                                            <td>
                                                @if ($appointment->user)
                                                    {{ ucfirst($appointment->user->firstname) }}
                                                    {{ ucfirst($appointment->user->lastname) }}
                                                @else
                                                    <span class="text-danger">No user</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($appointment->services && $appointment->services->count() > 0)
                                                    {{ $appointment->services->pluck('name')->join(', ') }}
                                                @else
                                                    Not available
                                                @endif
                                            </td>
                                            <td>{{ date('h:i A', strtotime($appointment->start_time)) }}</td>


                                            <td>
                                                @php
                                                    $statusWord = '';
                                                    $badgeClass = '';
                                                    switch ($appointment->status) {
                                                        case 1:
                                                            $statusWord = 'Pending';
                                                            $badgeClass = 'badge badge-warning';
                                                            break;
                                                        case 2:
                                                            $statusWord = 'Approved';
                                                            $badgeClass = 'badge badge-success';
                                                            break;
                                                        case 3:
                                                            $statusWord = 'Completed';
                                                            $badgeClass = 'badge badge-primary';
                                                            break;
                                                        case 4:
                                                            $statusWord = 'Cancelled';
                                                            $badgeClass = 'badge badge-danger';
                                                            break;
                                                        default:
                                                            $statusWord = 'Unknown';
                                                            $badgeClass = 'badge badge-secondary';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="{{ $badgeClass }}">{{ $statusWord }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" style="text-align: center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Appointments Modal -->
        <div class="modal fade" id="completedModal" tabindex="-1" role="dialog" aria-labelledby="completedModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="completedModalLabel">Completed Appointments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>PATIENT NAME</th>
                                        <th>SERVICE</th>
                                        <th>REFERENCE NUMBER</th>
                                    </tr>
                                </thead>
                                <tbody id="completedAppointmentsBody">
                                    <!-- Data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Appointments Modal -->
        <div class="modal fade" id="totalModal" tabindex="-1" role="dialog" aria-labelledby="totalModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="totalModalLabel">Total Appointments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>PATIENT NAME</th>
                                        <th>SERVICE</th>
                                        <th>REFERENCE NUMBER</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody id="totalAppointmentsBody">
                                    <!-- Data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Patients Modal -->
        <div class="modal fade" id="patientsModal" tabindex="-1" role="dialog" aria-labelledby="patientsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="patientsModalLabel">Total Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>EMAIL</th>
                                        <th>USER TYPE</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody id="patientsBody">
                                    <!-- Data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::user()->usertype == '3' || Auth::user()->usertype == '2')
        <style>
            .orange-text {
                color: orange;
            }
        </style>
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex mb-3 align-items-start">
                    <div class="mr-auto d-none d-lg-block">
                        <h1 class="text-black font-w600 mb-0">WELCOME TO <span class="orange-text">SMILETECH,</span> </h1>
                        <div class="weight-600 font-w600 text-blue" style="font-size: 2rem">
                            @if (Auth::user()->usertype == 2)
                                Dr.
                            @endif{{ Auth::user()->firstname }}
                            {{ Auth::user()->lastname }}
                        </div>
                        @if (Auth::user()->usertype == 3)
                            <h5>USER ID: {{ Auth::user()->id }}</h5>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-xxl-3 col-lg-12 col-md-12">
                        <div class="row">

                        </div>
                    </div>
                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="full-map-area mb-4">
                                                <img src="{{ asset('images/smilemap2.jpg') }}" alt="">
                                                <i class="flaticon-381-location-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            console.log('Document ready - Modal scripts initialized');

            // Chart initialization
            fetch("{{ route('chart.data') }}")
                .then(response => response.json())
                .then(data => {
                    var ctx = document.getElementById('appointment').getContext('2d');
                    var activityChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Appointments',
                                data: data.data,
                                backgroundColor: 'rgba(75, 192, 192, 0)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                })
                .catch(error => console.error('Chart error:', error));

            // Load completed appointments
            $('#completedModal').on('show.bs.modal', function() {
                console.log('Completed Modal opened');
                $.ajax({
                    url: "{{ route('appointments.completed') }}",
                    type: 'GET',
                    beforeSend: function() {
                        console.log('Fetching completed appointments...');
                        $('#completedAppointmentsBody').html(
                            '<tr><td colspan="4" class="text-center">Loading...</td></tr>');
                    },
                    success: function(data) {
                        console.log('Completed appointments data:', data);
                        let html = '';
                        if (data.length === 0) {
                            html =
                                '<tr><td colspan="4" class="text-center">No completed appointments found</td></tr>';
                        } else {
                            data.forEach(function(appointment) {
                                // Handle multiple services
                                let serviceNames = 'Not available';
                                if (appointment.services && appointment.services
                                    .length > 0) {
                                    serviceNames = appointment.services.map(function(
                                        service) {
                                        return service.name;
                                    }).join(', ');
                                }

                                html += '<tr>';
                                html += '<td>' + appointment.date + '</td>';
                                html += '<td>' + appointment.user.firstname + ' ' +
                                    appointment.user.lastname + '</td>';
                                html += '<td>' + serviceNames + '</td>';
                                html += '<td>' + appointment.reference_number + '</td>';
                                html += '</tr>';
                            });
                        }
                        $('#completedAppointmentsBody').html(html);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading completed appointments:', error);
                        console.error('Response:', xhr.responseText);
                        $('#completedAppointmentsBody').html(
                            '<tr><td colspan="4" class="text-center text-danger">Error loading data: ' +
                            error + '</td></tr>');
                    }
                });
            });

            // Load total appointments
            $('#totalModal').on('show.bs.modal', function() {
                console.log('Total Modal opened');
                $.ajax({
                    url: "{{ route('appointments.all') }}",
                    type: 'GET',
                    beforeSend: function() {
                        console.log('Fetching all appointments...');
                        $('#totalAppointmentsBody').html(
                            '<tr><td colspan="5" class="text-center">Loading...</td></tr>');
                    },
                    success: function(data) {
                        console.log('All appointments data:', data);
                        let html = '';
                        if (data.length === 0) {
                            html =
                                '<tr><td colspan="5" class="text-center">No appointments found</td></tr>';
                        } else {
                            data.forEach(function(appointment) {
                                let statusWord = '';
                                let badgeClass = '';
                                switch (appointment.status) {
                                    case 1:
                                        statusWord = 'Pending';
                                        badgeClass = 'badge badge-warning';
                                        break;
                                    case 2:
                                        statusWord = 'Approved';
                                        badgeClass = 'badge badge-success';
                                        break;
                                    case 3:
                                        statusWord = 'Completed';
                                        badgeClass = 'badge badge-primary';
                                        break;
                                    case 4:
                                        statusWord = 'Cancelled';
                                        badgeClass = 'badge badge-danger';
                                        break;
                                    default:
                                        statusWord = 'Unknown';
                                        badgeClass = 'badge badge-secondary';
                                }

                                // Handle multiple services
                                let serviceNames = 'Not available';
                                if (appointment.services && appointment.services
                                    .length > 0) {
                                    serviceNames = appointment.services.map(function(
                                        service) {
                                        return service.name;
                                    }).join(', ');
                                }

                                html += '<tr>';
                                html += '<td>' + appointment.date + '</td>';
                                html += '<td>' + appointment.user.firstname + ' ' +
                                    appointment.user.lastname + '</td>';
                                html += '<td>' + serviceNames + '</td>';
                                html += '<td>' + appointment.reference_number + '</td>';
                                html += '<td><span class="' + badgeClass + '">' +
                                    statusWord + '</span></td>';
                                html += '</tr>';
                            });
                        }
                        $('#totalAppointmentsBody').html(html);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading all appointments:', error);
                        console.error('Response:', xhr.responseText);
                        $('#totalAppointmentsBody').html(
                            '<tr><td colspan="5" class="text-center text-danger">Error loading data: ' +
                            error + '</td></tr>');
                    }
                });
            });
            // Load total patients
            $('#patientsModal').on('show.bs.modal', function() {
                console.log('Patients Modal opened');
                $.ajax({
                    url: "{{ route('users.all') }}",
                    type: 'GET',
                    beforeSend: function() {
                        console.log('Fetching all patients...');
                        $('#patientsBody').html(
                            '<tr><td colspan="5" class="text-center">Loading...</td></tr>');
                    },
                    success: function(data) {
                        console.log('All patients data:', data);
                        let html = '';
                        if (data.length === 0) {
                            html =
                                '<tr><td colspan="6" class="text-center">No patients found</td></tr>';
                        } else {
                            data.forEach(function(patient) {
                                // Determine status badge
                                let statusBadge = '';
                                if (patient.status === 1 || patient.status === '1' ||
                                    patient.status === 'active') {
                                    statusBadge =
                                        '<span class="badge badge-success">Active</span>';
                                } else {
                                    statusBadge =
                                        '<span class="badge badge-danger">Inactive</span>';
                                }

                                // Determine usertype badge from numeric values
                                let usertypeBadge = '';
                                switch (parseInt(patient.usertype)) {
                                    case 1:
                                        usertypeBadge =
                                            '<span class="">Admin</span>';
                                        break;
                                    case 2:
                                        usertypeBadge =
                                            '<span class="">Doctor</span>';
                                        break;
                                    case 3:
                                        usertypeBadge =
                                            '<span class="">Patient</span>';
                                        break;
                                    default:
                                        usertypeBadge =
                                            '<span class="">Unknown</span>';
                                }

                                html += '<tr>';
                                html += '<td>' + patient.id + '</td>';
                                html += '<td>' + patient.firstname + '</td>';
                                html += '<td>' + patient.lastname + '</td>';
                                html += '<td>' + patient.email + '</td>';
                                html += '<td>' + usertypeBadge + '</td>';
                                html += '<td>' + statusBadge + '</td>';
                                html += '</tr>';
                            });
                        }
                        $('#patientsBody').html(html);

                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading patients:', error);
                        console.error('Response:', xhr.responseText);
                        $('#patientsBody').html(
                            '<tr><td colspan="5" class="text-center text-danger">Error loading data: ' +
                            error + '</td></tr>');
                    }
                });
            });

            // Service filter
            $('#statusFilter').change(function() {
                var status = $(this).val();
                $('#example3 tbody tr').show();
                if (status) {
                    $('#example3 tbody tr').not(':contains(' + status + ')').hide();
                }
            });
        });
    </script>
@endsection
