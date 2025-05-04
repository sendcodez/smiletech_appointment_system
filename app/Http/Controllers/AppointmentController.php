<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Mail\AppointmentCancelled;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        $appointments = Appointment::where('user_id', Auth::id())->get();

        // Fetch store close days from the database
        $storeCloseDays = Website::pluck('store_close')->first();

    $bookedMorningCount = DB::table('appointments')
            ->select(DB::raw('DATE(date) as date'), DB::raw('COUNT(*) as count'))
            ->where('time', 'morning')
            ->where('status', '!=', 4)
            ->groupBy('date')
            ->get();
    
    $bookedAfternoonCount = DB::table('appointments')
            ->select(DB::raw('DATE(date) as date'), DB::raw('COUNT(*) as count'))
            ->where('time', 'afternoon')
            ->where('status', '!=', 4)
            ->groupBy('date')
            ->get();

        $maxMorningAppointments = Website::first()->customer_morning;
        $maxAfternoonAppointments = Website::first()->customer_afternoon;

        //dd($bookedMorningCount, $bookedAfternoonCount, $maxMorningAppointments, $maxAfternoonAppointments);

        // Convert the store close days from JSON to an array
        $storeCloseDays = json_decode($storeCloseDays);
        $bookedMorningCount = json_decode($bookedMorningCount);
        $bookedAfternoonCount = json_decode($bookedAfternoonCount);
        


        return view('patient.appointment', compact('appointments', 'services', 'storeCloseDays', 'bookedMorningCount', 'bookedAfternoonCount', 'maxMorningAppointments', 'maxAfternoonAppointments'));
        
    }
    public function getAppointments(Request $request)
    {
        $date = $request->input('date');
    
        // Query morning appointments for the selected date
        $bookedMorningCount = DB::table('appointments')
            ->select(DB::raw('DATE(date) as date'), DB::raw('COUNT(*) as count'))
            ->where('time', 'morning')
            ->whereDate('date', $date)
            ->where('status', '!=', 4)
            ->groupBy('date')
            ->get();
    
        // Query afternoon appointments for the selected date
        $bookedAfternoonCount = DB::table('appointments')
            ->select(DB::raw('DATE(date) as date'), DB::raw('COUNT(*) as count'))
            ->where('time', 'afternoon')
            ->whereDate('date', $date)
            ->where('status', '!=', 4)
            ->groupBy('date')
            ->get();
    
        // Assuming `customer_morning` and `customer_afternoon` are properties of the Website model
        $maxMorningAppointments = Website::first()->customer_morning;
        $maxAfternoonAppointments = Website::first()->customer_afternoon;
    
        return response()->json([
            'bookedMorningCount' => $bookedMorningCount,
            'bookedAfternoonCount' => $bookedAfternoonCount,
            'maxMorningAppointments' => $maxMorningAppointments,
            'maxAfternoonAppointments' => $maxAfternoonAppointments,
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
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'service_id' => 'required|array',
                'service_id.*' => 'exists:services,id',
                'date' => 'required|date',
                'day' => 'required|string',
                'time' => 'required|string',
                'cancellation_reason' => 'nullable|string', // Validation for cancellation_reason
            ]);
    
            $currentYear = date('Y');
            $randomInteger = random_int(10000000, 99999999);
    
            // Create the appointment
            $appointment = Appointment::create([
                'user_id' => $validatedData['user_id'],
                'date' => $validatedData['date'],
                'day' => $validatedData['day'],
                'time' => $validatedData['time'],
                'reference_number' => $currentYear . $randomInteger,
                'cancellation_reason' => $validatedData['cancellation_reason'] ?? null, // Store reason if available
            ]);
    
            $appointment->services()->attach($validatedData['service_id']);
    
            return back()->with('success', 'Service added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    


    public function cancel(Request $request, $id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);
        
        // Check if the cancellation reason is provided
        if ($request->has('cancellation_reason')) {
            $appointment->cancellation_reason = $request->input('cancellation_reason');
        }
    
        // Update the appointment status to cancelled
        $appointment->status = 4;
        $appointment->save();
    
        // Send cancellation email to user
        Mail::to($appointment->user->email)->send(new AppointmentCancelled($appointment));
        
        // Log cancellation action if user is an admin
        if (Auth::user()->usertype === 1 || Auth::user()->usertype === 2) {
            $user = Auth::user();
            $action = 'cancel_appointment';
            $description = 'Cancelled an appointment with reference number: ' . $appointment->reference_number;
       
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
        }
    
        // Return success response
        return redirect()->back()->with('success', 'Appointment cancelled successfully');
    }
    
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
    public function destroy($id)
    {
        // Find the doctor record
        $appointment = Appointment::findOrFail($id);

        // Soft delete the User
        $appointment->delete();

        $user = Auth::user();
        $action = 'deleted_appointment';
        $description = 'Deleted appointment with reference number: ' . $appointment->reference_number;
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function complete($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);

        // Update the status to 'cancelled' (status code 4)
        $appointment->status = 3;
        $appointment->save();

        $user = Auth::user();
        $action = 'complete_appointment';
        $description = 'Dr.'. $appointment->user->firstname . ' ' . $appointment->user->lastname.' '. 'completed an appointment.';

        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);

        // Optionally, you can redirect the user back or return a response
        return redirect()->back()->with('success', 'Appointment completed successfully');
    }

    public function reschedule(Request $request)
{
    try {
        $validatedData = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string|in:morning,afternoon',
        ]);

        $appointment = Appointment::findOrFail($validatedData['appointment_id']);

        // Optional: Prevent rescheduling if status is completed or cancelled
        if (in_array($appointment->status, [3, 4])) {
            return back()->with('error', 'Cannot reschedule a completed or cancelled appointment.');
        }

        $appointment->update([
            'date' => $validatedData['date'],
            'day' => \Carbon\Carbon::parse($validatedData['date'])->format('l'),
            'time' => $validatedData['time'],
        ]);

        return back()->with('success', 'Appointment rescheduled successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


}
