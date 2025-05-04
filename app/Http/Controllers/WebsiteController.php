<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Models\Website;
class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web = Website::first(); 
        return view('admin.website', compact('web'));
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
    public function update(Request $request)
    {
        $web = Website::first(); 
        $storeClose = json_encode($request->store_close);

        $web->update([
            'business_name' => $request->business_name,
            'tagline' => $request->tagline,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'about' => $request->about,
            'store_hour_start' => $request->store_hour_start,
            'store_hour_end' => $request->store_hour_end,
             'store_close' => $storeClose, // Store the JSON-encoded array
            'customer_morning' => $request->customer_morning,
            'customer_afternoon' => $request->customer_afternoon,

 
        ]);

        $logo = $request->file('logo');
    
        if ($logo) {
           
            $currentDateTime = now()->format('Ymd_His');
        
           
            $originalFileName = $request->logo->getClientOriginalName();
        
           
            $logoName = $currentDateTime . '_' . $originalFileName;
        
            
            $destinationPath = public_path('web_images');
        
          
            if ($logo->move($destinationPath, $logoName)) {
                
                $web->update(['logo' => $logoName]);
            } else {
                
                return redirect()->back()->with('error', 'Failed to update website data. Please try again.');
            }
        }

        $bg = $request->file('bg');
    
        if ($bg) {
           
            $currentDateTime = now()->format('Ymd_His');
        
           
            $originalFileName = $request->bg->getClientOriginalName();
        
           
            $bgName = $currentDateTime . '_' . $originalFileName;
        
            
            $destinationPath = public_path('web_images');
        
          
            if ($bg->move($destinationPath, $bgName)) {
                
                $web->update(['bg_image' => $bgName]);
            } else {
                
                return redirect()->back()->with('error', 'Failed to update website data. Please try again.');
            }
        }
    
        $user = Auth::user();
        $action = 'update_website';
        $description = 'Updated our website';
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'Website updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
