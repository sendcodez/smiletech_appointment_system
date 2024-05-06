<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Result;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::where('user_id', Auth::id())->get();

        return view ('patient.patient_record', compact('results'));
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
                'fullname' => 'required|string|max:255',
                'date' => 'required|date',
                'time' => 'required|string|max:255',
                'number' => 'required|integer',
                'description' => 'required|string', 
              
            ]);

            // Save the form data into the database
            $result = Result::create([
              
                'user_id' => $validatedData['user_id'],
                'fullname' => $validatedData['fullname'],
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
                'number' => $validatedData['number'],
                'description' => $validatedData['description'],
               
        
            ]);

            $updateResult = Appointment::where([
                'user_id' => $validatedData['user_id'],
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
            ])->update(['status' => 3]);

            if (!$updateResult) {
                // Update failed
                throw new \Exception('Appointment status update failed.');
            }            
            $user = Auth::user();
            $action = 'added_result';
            $description = 'Added a result for patient: ' . $result->fullname;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return back()->with('success', 'Result added successfully.');
        }  catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
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
