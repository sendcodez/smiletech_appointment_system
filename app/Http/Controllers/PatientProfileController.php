<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MedicalHistories;
use App\Models\MedicalConditions;
class PatientProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $patients = User::with(['medicalHistory', 'medicalConditions'])
    ->where('usertype', 3) // or however you identify patients
    ->get();
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
            // User fields
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string',
            'contact' => ['required', 'regex:/^09\d{9}$/'],
            'contact_person' => 'nullable|string',
            'contact_person_number' => 'nullable|string',
            'usertype' => 'nullable|integer',
            
            // Medical history fields
            'antibiotic' => 'nullable|in:yes,no',
            'anaesthesia' => 'nullable|in:yes,no',
            'smoke' => 'nullable|in:yes,no',
            'pregnant' => 'nullable|in:yes,no',
            'doctor' => 'nullable|in:yes,no',
            'prescription' => 'nullable|in:yes,no',
            'hospitalized' => 'nullable|in:yes,no',
            'medications' => 'nullable|string',
            'allergies' => 'nullable|string',
            'known_allergies' => 'nullable|string',
            
            // Medical conditions fields
            'steriod' => 'nullable|in:yes,no',
            'kidney_disease' => 'nullable|in:yes,no',
            'prosthetic_implant' => 'nullable|in:yes,no',
            'rheumatic' => 'nullable|in:yes,no',
            'excessive_bleeding' => 'nullable|in:yes,no',
            'cardiac_pacemaker' => 'nullable|in:yes,no',
            'epilepsy' => 'nullable|in:yes,no',
            'stroke' => 'nullable|in:yes,no',
            'stomach_condition' => 'nullable|in:yes,no',
            'asthma' => 'nullable|in:yes,no',
            'cancer' => 'nullable|in:yes,no',
            'hepatitis' => 'nullable|in:yes,no',
            'diabetes' => 'nullable|in:yes,no',
            'tuberculosis' => 'nullable|in:yes,no',
            'blood_borne' => 'nullable|in:yes,no',
            'heart_disorder' => 'nullable|in:yes,no',
            'thyroid_disease' => 'nullable|in:yes,no',
            'bronchitis' => 'nullable|in:yes,no',
            'bone_disease' => 'nullable|in:yes,no',
            'nervous' => 'nullable|in:yes,no',
            'anaemia' => 'nullable|in:yes,no',
            'radiation' => 'nullable|in:yes,no',
            'high_blood' => 'nullable|in:yes,no',
            'other_condition' => 'nullable|in:yes,no',
        ]);

    

        // Helper function to convert yes/no to 1/0
        $convertYesNo = function($value) {
            return $value === 'yes' ? 1 : 0;
        };

        // Use database transaction
        DB::beginTransaction();

        // 1. Create the user
        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'middlename' => $validatedData['middlename'] ?? null,
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'birthday' => $validatedData['birthday'] ?? null,
            'address' => $validatedData['address'] ?? null,
            'number' => $validatedData['contact'] ?? null,
            'contact_person' => $validatedData['contact_person'] ?? null,
            'contact_person_number' => $validatedData['contact_person_number'] ?? null,
            'usertype' => '3',
        ]);

        

        // 2. Create medical history record
        $medicalHistory = MedicalHistories::create([
            'user_id' => $user->id,
            'antibiotic' => $convertYesNo($validatedData['antibiotic'] ?? 'no'),
            'abnormal' => $convertYesNo($validatedData['abnormal'] ?? 'no'),
            'smoke' => $convertYesNo($validatedData['smoke'] ?? 'no'),
            'pregnant' => $convertYesNo($validatedData['pregnant'] ?? 'no'),
            'treated' => $convertYesNo($validatedData['treated'] ?? 'no'),
            'prescription' => $convertYesNo($validatedData['prescription'] ?? 'no'),
            'hospitalized' => $convertYesNo($validatedData['hospitalized'] ?? 'no'),
            'medications' => $validatedData['medications'] ?? 'N/A',
            'allergies' => $validatedData['allergies'] ?? 'N/A',
            'known_allergies' => $validatedData['known_allergies'] ?? 'N/A',
        ]);

       

        // 3. Create medical conditions record
        $medicalCondition = MedicalConditions::create([
            'user_id' => $user->id,
            'steriod' => $convertYesNo($validatedData['steriod'] ?? 'no'),
            'kidney_disease' => $convertYesNo($validatedData['kidney_disease'] ?? 'no'),
            'prosthetic_implant' => $convertYesNo($validatedData['prosthetic_implant'] ?? 'no'),
            'rheumatic' => $convertYesNo($validatedData['rheumatic'] ?? 'no'),
            'excessive_bleeding' => $convertYesNo($validatedData['excessive_bleeding'] ?? 'no'),
            'cardiac_pacemaker' => $convertYesNo($validatedData['cardiac_pacemaker'] ?? 'no'),
            'epilepsy' => $convertYesNo($validatedData['epilepsy'] ?? 'no'),
            'stroke' => $convertYesNo($validatedData['stroke'] ?? 'no'),
            'stomach_condition' => $convertYesNo($validatedData['stomach_condition'] ?? 'no'),
            'asthma' => $convertYesNo($validatedData['asthma'] ?? 'no'),
            'cancer' => $convertYesNo($validatedData['cancer'] ?? 'no'),
            'hepatitis' => $convertYesNo($validatedData['hepatitis'] ?? 'no'),
            'diabetes' => $convertYesNo($validatedData['diabetes'] ?? 'no'),
            'tuberculosis' => $convertYesNo($validatedData['tuberculosis'] ?? 'no'),
            'blood_borne' => $convertYesNo($validatedData['blood_borne'] ?? 'no'),
            'heart_disorder' => $convertYesNo($validatedData['heart_disorder'] ?? 'no'),
            'thyroid_disease' => $convertYesNo($validatedData['thyroid_disease'] ?? 'no'),
            'bronchitis' => $convertYesNo($validatedData['bronchitis'] ?? 'no'),
            'bone_disease' => $convertYesNo($validatedData['bone_disease'] ?? 'no'),
            'nervous' => $convertYesNo($validatedData['nervous'] ?? 'no'),
            'anaemia' => $convertYesNo($validatedData['anaemia'] ?? 'no'),
            'radiation' => $convertYesNo($validatedData['radiation'] ?? 'no'),
            'high_blood' => $convertYesNo($validatedData['high_blood'] ?? 'no'),
            'other_condition' => $convertYesNo($validatedData['other_condition'] ?? 'no'),
        ]);

    

        // 4. Create activity log (only if user is authenticated)
        if (Auth::check()) {
            $authUser = Auth::user();
            ActivityLog::create([
                'user_id' => $authUser->id,
                'name' => $authUser->firstname,
                'action' => 'added_user',
                'description' => 'Added a user: ' . $user->firstname . ' ' . $user->lastname,
            ]);
        }

        // Commit the transaction
        DB::commit();

       

        return redirect()->back()->with('success', 'User registered successfully with medical information.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
    
        return redirect()->back()->withErrors($e->errors())->withInput();
        
    } catch (\Exception $e) {
        DB::rollBack();
        

        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
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
    try {
        DB::beginTransaction();
        
        $user = User::findOrFail($id);
        $patientName = $user->firstname . ' ' . $user->lastname;
        
        // Delete related records first
        MedicalHistories::where('user_id', $id)->delete();
        MedicalConditions::where('user_id', $id)->delete();
        
        // Delete the user
        $user->delete();
        
        // Create activity log
        if (Auth::check()) {
            $authUser = Auth::user();
            ActivityLog::create([
                'user_id' => $authUser->id,
                'name' => $authUser->firstname,
                'action' => 'deleted_patient',
                'description' => 'Deleted patient: ' . $patientName,
            ]);
        }
        
        DB::commit();
        
        return redirect()->back()->with('success', 'Patient deleted successfully.');
        
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'An error occurred while deleting the patient: ' . $e->getMessage());
    }
}
}