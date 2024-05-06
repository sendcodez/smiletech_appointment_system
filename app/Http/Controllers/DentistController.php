<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dentist;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class DentistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
     public function index()
     {
         $dentists = Dentist::all();
 
         return view ('admin.add_dentist', compact('dentists'));
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
                'contact_number' => 'required|string|max:255',
                'address' => 'required|string|max:255', 
                'about' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:30748'
            ]);
            $image = $request->file('image');

            // Concatenate the dentist's name with the filename
            $imageName = $validatedData['firstname'] .  '_' .   $validatedData['lastname'] .  '_'  . time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded file to the desired public path
            $image->move(public_path('dentist_image'), $imageName);
            // Save the form data into the database

            $user = User::create([
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'usertype' => 2,
                'password' => bcrypt($validatedData['password']),
            ]);

            $dentist = Dentist::create([
                'user_id' => $user->id,
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'contact_number' => $validatedData['contact_number'],
                'address' => $validatedData['address'],
                'about' => $validatedData['about'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'image' => $imageName,
        
            ]);

            
            
    
            $user = Auth::user();
            $action = 'added_dentist';
            $description = 'Added a dentist: Dr. ' . $dentist->lastname;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return back()->with('success', 'Dentist added successfully.');
        } catch (\Exception $e) {
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
            $dentist = Dentist::findOrFail($id);

            $request->validate([
                'firstname' => 'required|string|max:255',
                'middlename' => 'nullable|string|max:255',
                'lastname' => 'required|string|max:255',
                'contact_number' => 'required|string|max:255',
                'address' => 'required|string|max:255', 
                'about' => 'required|string|max:255',
                'email' => 'required|email|',
                'password' => 'required|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:30748'
            ]);

            // Update dentist properties
            $dentist->firstname = $request->input('firstname');
            $dentist->middlename = $request->input('middlename');
            $dentist->lastname = $request->input('lastname');
            $dentist->contact_number = $request->input('contact_number');
            $dentist->address = $request->input('address');
            $dentist->about = $request->input('about');
            $dentist->email = $request->input('email');
            $dentist->password = $request->input('password');

            // Upload new image if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $dentist->firstname . '_' . $dentist->lastname . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('dentist_image'), $imageName);
                $dentist->image = $imageName;
            }
            $user = Auth::user();
            $action = 'update_dentist';
            $description = 'Updated an information for: Dr. ' . $dentist->firstname . ' ' . $dentist->lastname;
    
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            $dentist->save();



            return redirect()->back()->with('success', 'Dentist updated successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            Log::error('Error occurred while updating dentist: ' . $e->getMessage());
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the dentist record
        $dentist = Dentist::findOrFail($id);

        // Soft delete the service
        $dentist->delete();

        $user = Auth::user();
        $action = 'delete_dentist';
        $description = 'Deleted dentist: Dr. ' . $dentist->lastname;
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'Dentist deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $dentist = Dentist::findOrFail($id);
        if ($request->has('status')) {
            $dentist->status = $request->status;
            $dentist->save();

            $user = Auth::user();
            $action = 'update_dentist';
            $description = 'Update a dentist status: Dr. ' . $dentist->lastname;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return redirect()->back()->with('success', 'Dentist status updated successfully.');
        }
        return redirect()->back()->with('error', 'No status provided.');
    }
}
