<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Mail\AppointmentApproved;
use Illuminate\Support\Facades\Mail;

class ManageAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index()
    {
        $services = Service::all();
        $manage_app = Appointment::orderBy('date', 'desc')->get();


        return view('admin.manage_appointment', compact('manage_app', 'services',));

    }

    public function approve($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 2;
        $appointment->save();

        Mail::to($appointment->user->email)->send(new AppointmentApproved($appointment));

        if (Auth::user()->usertype === 1 || Auth::user()->usertype === 2) {
            // Log the cancellation if the user is an admin
            $user = Auth::user();
            $action = 'approve_appointment';
            $description = 'Approved an appointment on ith reference number: ' . $appointment->reference_number;

            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
        }
        return redirect()->back()->with('success', 'Appointment approved successfully');
    }
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
