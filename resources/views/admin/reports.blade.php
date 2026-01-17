@extends('layouts.sidebar')
@section('title', 'Reports')


@section('contents')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Generate Report</h4>
                    </div>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter Options</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('reports.filter') }}">
                                @csrf
                                <div class="row align-items-end">

                                    <!-- Start Date -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="startDate">Start Date:</label>
                                            <input type="date" id="startDate" name="startDate" class="form-control">
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="endDate">End Date:</label>
                                            <input type="date" id="endDate" name="endDate" class="form-control">
                                        </div>

                                    </div>

                                    <!-- Services Filter -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="servicesFilter">Services</label>
                                            <select id="servicesFilter" class="selectpicker form-control">
                                                <option value="">All</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->name }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Status Filter -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="statusFilter">Status</label>
                                            <select id="statusFilter" class="selectpicker form-control">
                                                <option value="">All</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Filter Button -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-block">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-success float-right"
                                    onclick="printTable()">Print</button>
                                <table id="example3" class="display" style="min-width: 845px">
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
                                                <td>{{ ucfirst($appointment->user->firstname) }}
                                                    {{ ucfirst($appointment->user->lastname) }}</td>
                                                <td>
                                                    @if ($appointment->services->isNotEmpty())
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
                                                                $badgeClass = 'badge badge-primary';
                                                                break;
                                                            case 3:
                                                                $statusWord = 'Completed';
                                                                $badgeClass = 'badge badge-success  ';
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
                                                <td colspan="5" style="text-align: center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        function printTable() {
            var headerContent = `

          <style>
        @media print {
          @page {
              margin-top: 30; /* Remove the default margin */
          }
          @page :first {
              margin-top: 30; /* Remove the default margin on first page */
          }
          @page {
              size: auto;   /* auto is the initial value */
              margin: 30;  /* this affects the margin in the printer settings */
          }
          @page {
              size: auto;   /* auto is the initial value */
              margin: 30;  /* this affects the margin in the printer settings */
          }
          .date-header{
              display: none; /* Hide the date and page number */
          }
      }
          .store{
            text-align:center;
            font-size:1.5rem;
          }

  </style>
  <div style="text-align: center;">
      <img src="{{ asset('web_images/smiletech_logo.png') }}" alt="Left Logo" style="max-width: 110px;max-height:100px;position: absolute; top: 0; left: 0;">

      <span style="font-size: 40px;">SMILETECH</span>
      <br>
      <span style="font-size: 20px;">Barangay Lantic, City of Carmona, Cavite</span>
      <br>
      <i><span style="font-size: 15px;">0909-111-2222</span></i>
      <br>
  </div>
  <br>
  <hr>

  <div class="store">
    <h3>APPOINTMENTS REPORT</h3>
  </div>

  `;
            document.querySelectorAll('.no-print').forEach(function(element) {
                element.style.display = 'none';
            });
            var totalAppointments = "{{ count($appointments) }}";
            var startDate = "{{ $startDate ?? '' }}";
            var endDate = "{{ $endDate ?? '' }}";
            var prepared = "{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}";
            var content = document.getElementById('example3').outerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title></head><body onload="window.print()">');
            printWindow.document.write(headerContent);
            printWindow.document.write('<style>');
            printWindow.document.write('@media print { body { font-size: 14px; } img { width: 2in; height: auto; } }');
            printWindow.document.write('.header { display: flex; align-items: center; justify-content: space-between; }');
            printWindow.document.write('.logo { width: 20%; }');
            printWindow.document.write('.title { width: 80%; text-align: center; font-size: 1.5rem; }');
            printWindow.document.write(
                '.designation { text-align: left; font-family: Arial, sans-serif; font-weight: 100;font-size:13px;margin-top:-2%; }'
            ); // Added designation class
            printWindow.document.write('.address { width: 20%; text-align: right; }');
            printWindow.document.write('.display { border-collapse: collapse; width: 100%; }');
            printWindow.document.write('.display th, .display td { border: 1px solid #ddd; padding: 8px; }');
            printWindow.document.write('.display th { background-color: #f2f2f2; }');
            printWindow.document.write('.display tr:nth-child(even) { background-color: #f2f2f2; }');
            printWindow.document.write('.display tr:hover { background-color: #ddd; }');
            printWindow.document.write(
                '.display th { padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #FD8700; color: white; }'
            );
            printWindow.document.write('.store-name { font-size: 36px; }');
            printWindow.document.write('</style></head>')
            printWindow.document.write('<p style="text-align:center;">From: ' + startDate + '</p>');
            printWindow.document.write('<p style="text-align:center;">To: ' + endDate + '</p>');
            printWindow.document.write(content);
            printWindow.document.write('<p style="text-align:left;"><b>Prepared by:</p></b>');
            printWindow.document.write('<p style="text-align:left;font-size:1.3rem;"><b>' + prepared + '</b></p>');
            printWindow.document.write('<p class="designation">Administrator</p>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
        }


        function applyFilters() {
            var selectedService = $('#servicesFilter').val();
            var selectedStatus = $('#statusFilter').val();

            $('#example3 tbody tr').each(function() {
                var row = $(this);
                var matchesService = selectedService ? row.text().toLowerCase().indexOf(selectedService
                    .toLowerCase()) !== -1 : true;
                var matchesStatus = selectedStatus ? row.text().toLowerCase().indexOf(selectedStatus
                    .toLowerCase()) !== -1 : true;

                if (matchesService && matchesStatus) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        }

        $('#servicesFilter').change(function() {
            applyFilters();
        });

        $('#statusFilter').change(function() {
            applyFilters();
        });

        $(document).ready(function() {
            applyFilters();
        });
    </script>
@endsection
