<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.manage_users', compact('users')); 
    }

    /**
     * Show the form for creating a new resource.
     */

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
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
                'usertype' => 'required|integer',
                
                
            ]);
        
            // Save the form data into the database
            $user = User::create([
               
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'usertype' => $validatedData['usertype'],
        
            ]);
            
    
            $user = Auth::user();
            $action = 'added_service';
            $description = 'Added a user: ' . $user->firstname . $user->lastname;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return back()->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            Log::error('Error occurred while updating dentist: ' . $e->getMessage());
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
    public function destroy($id)
    {
        // Find the doctor record
        $user = User::findOrFail($id);

        // Soft delete the user
        $user->delete();

        $user = Auth::user();
        $action = 'delete_user';
        $description = 'Deleted user: ' . $user->firstname . $user->lastname;
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->has('status')) {
            $user->status = $request->status;
            $user->save();

            $user = Auth::user();
            $action = 'update_user';
            $description = 'Update a user status: ' . $user->firstname . $user->lastname;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return redirect()->back()->with('success', 'User status updated successfully.');
        }
        return redirect()->back()->with('error', 'No status provided.');
    }
}
