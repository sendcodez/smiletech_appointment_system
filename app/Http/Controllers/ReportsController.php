<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.reports', ['appointments' => [], 'services' => $services]);
    }
    public function filter(Request $request)
    {

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $services = Service::all();
        
        // Query appointments within the selected date range
        $appointments = Appointment::whereBetween('date', [$startDate, $endDate])->get();
       
        return view('admin.reports', [
            'appointments' => $appointments,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'services' => $services,
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
