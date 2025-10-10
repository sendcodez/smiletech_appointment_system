<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
class PatientProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();

        return view ('admin.profiling', compact('patients'));
    }
    public function getAllPatients() {
    return response()->json(Patient::all());
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
                'firstname' => 'required|string|max:255',
                'middlename' => 'nullable|string|max:255',
                'lastname' => 'required|string|max:255',
                'birthday' => 'required|date',
                'sex' => 'required|string|max:25',
                'age' => 'required|integer',
                'address' => 'required|string|max:255',
                'occupation' => 'nullable|string|max:255',
                'contact_number' => 'nullable|string',

            ]);

            // Save the form data into the database
            $patient = Patient::create([

                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'birthday' => $validatedData['birthday'],
                'sex' => $validatedData['sex'],
                'age' => $validatedData['age'],
                'address' => $validatedData['address'],
                'occupation' => $validatedData['occupation'],
                'contact_number' => $validatedData['contact_number'],

            ]);


            $user = Auth::user();
            $action = 'added_patient';
            $description = 'Added a patient information: ' . $patient->firstname . ' '. $patient->lastname;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return back()->with('success', 'Patient Information added successfully.');
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
        try {

            $patient = Patient::findOrFail($id);

            $request->validate([
                'firstname' => 'required|string|max:255',
                'middlename' => 'nullable|string|max:255',
                'lastname' => 'required|string|max:255',
                'birthday' => 'required|date',
                'sex' => 'required|string|max:25',
                'age' => 'required|integer',
                'address' => 'required|string|max:255',
                'occupation' => 'nullable|string|max:255',
                'contact_number' => 'nullable|string',

            ]);


            $patient->firstname = $request->input('firstname');
            $patient->middlename = $request->input('middlename');
            $patient->lastname = $request->input('lastname');
            $patient->contact_number = $request->input('contact_number');
            $patient->address = $request->input('address');
            $patient->sex = $request->input('sex');
            $patient->age = $request->input('age');
            $patient->birthday = $request->input('birthday');
            $patient->occupation = $request->input('occupation');


            $user = Auth::user();
            $action = 'update_patient';
            $description = 'Updated a information for:' . $patient->firstname . ' ' . $patient->lastname;

            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            $patient->save();

            return redirect()->back()->with('success', 'Patient updated successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the doctor record
        $patient = Patient::findOrFail($id);

        // Soft delete the User
        $patient->delete();

        $user = Auth::user();
        $action = 'deleted_patient';
        $description = 'Deleted patient information: ' . $patient->firstname .' '. $patient->lastname;
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'Patient deleted successfully.');
    }
}
