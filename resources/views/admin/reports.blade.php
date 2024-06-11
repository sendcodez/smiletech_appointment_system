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
                            
                            <div class="col-md-6 col-sm-6">
                                <form method="POST" action="{{ route('reports.filter') }}">
                                    @csrf
                                    <div class="form-group">
                         
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label for="startDate">Start Date:</label>
                                                    <input type="date" id="startDate" name="startDate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label for="endDate">End Date:</label>
                                                    <input type="date" id="endDate" name="endDate" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info">Filter</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-success float-right" onclick="printTable()">Print</button>
                                <table id="example3" class="display" style="min-width: 845px">
                                    <div class="col-md-2 col-sm-6">
                                        <div class="form-group">
                                            <label for="statusFilter">Filter by Services:</label>
                                            <select id="statusFilter" class="selectpicker form-control">
                                                <option value="">All</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->name }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th class="no-print">#</th>
                                            <th>Patient Name</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($appointments as $key => $appointment)
                                            <tr>
                                                <td class="no-print">{{ $loop->iteration }}</td>
                                                <td>{{ ucfirst($appointment->user->firstname) }}
                                                    {{ ucfirst($appointment->user->lastname) }}</td>
                                                <td>{{ $appointment->service ? $appointment->service->name : "Not available" }}</td>
                                                <td>{{ $appointment->date }}</td>
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
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>

function printTable() {
    document.querySelectorAll('.no-print').forEach(function(element) {
        element.style.display = 'none';
    });
            
    var totalAppointments = "{{ count($appointments) }}";
    var startDate = "{{ $startDate ?? '' }}";
    var endDate = "{{ $endDate ?? '' }}";
    var content = document.getElementById('example3').outerHTML;
    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write(
        '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">'
    );
    printWindow.document.write('<style>');
    printWindow.document.write('@media print { body { font-size: 14px; } img { width: 2in; height: auto; } }');
    printWindow.document.write('.header { display: flex; align-items: center; }');
    printWindow.document.write('.logo { width: 20%; }');
    printWindow.document.write('.title { width: 80%; text-align: center;font-size:200px; }');
    printWindow.document.write('.display { border-collapse: collapse; width: 100%; }');
    printWindow.document.write('.display th, .display td { border: 1px solid #ddd; padding: 8px; }');
    printWindow.document.write('.display th { background-color: #f2f2f2; }');
    printWindow.document.write('.display tr:nth-child(even) { background-color: #f2f2f2; }');
    printWindow.document.write('.display tr:hover { background-color: #ddd; }');
    printWindow.document.write(
        '.display th { padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #FD8700; color: white; }'
    );
     printWindow.document.write('.store-name { font-size: 36px; }'); 
    printWindow.document.write('</style></head><body onload="window.print()">');
    // Include your store logo image here
    printWindow.document.write('<div class="header"><div class="logo"><img src="{{ asset('web_images/smiletech_logo.png') }}" alt="Store Logo"></div><div class="title" style="font-size:1.5rem"><h1 class="storename">APPOINTMENTS REPORT</h1></div></div>');
    printWindow.document.write('<p>From: ' + startDate    + '</p>');
    printWindow.document.write('<p>To: ' + endDate    + '</p>');
    printWindow.document.write('<p>Total Appointment: ' + totalAppointments + '</p>');
    printWindow.document.write(content.replace(/<span class="badge[^>]+>(.*?)<\/span>/gi,
        '$1')); // Removing badge classes
    printWindow.document.write('</body></html>');
    printWindow.document.close();
}  
        $('#statusFilter').change(function() {
        var status = $(this).val();
        $('#example3 tbody tr').show(); // Show all rows
        if (status) {
            $('#example3 tbody tr').not(':contains(' + status + ')').hide(); // Hide rows not matching selected status
        }
    }); 
</script>
@endsection
