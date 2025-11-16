<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalAppointments = Appointment::count();

        $totalPatients = Patient::count();
        $totalUsers = User::count();

        $completedAppointments = Appointment::where('status', 3)->count();
        $services = Service::all();
        $appointments = Appointment::all();


        return view('admin.dashboard', compact('totalAppointments', 'totalPatients', 'completedAppointments','services','appointments','totalUsers'));
    }

    public function chartData()
    {
        // Fetching monthly appointment data
        $appointmentsPerMonth = Appointment::selectRaw('count(*) as count, YEAR(date) year, MONTH(date) month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Extracting labels and data for the chart
        $labels = [];
        $data = [];

        foreach ($appointmentsPerMonth as $appointment) {
            $labels[] = Carbon::createFromDate($appointment->year, $appointment->month)->format('F Y');
            $data[] = $appointment->count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}