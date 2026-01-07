<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        return view ('admin.add_service', compact('services'));
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
                'name' => 'required|string|max:255',
                'price' => 'nullable|string',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif|max:30748'
            ]);
            $image = $request->file('image');

            // Concatenate the doctor's name with the filename
            $imageName = $validatedData['name'] .  '_' . time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded file to the desired public path
            $image->move(public_path('service_image'), $imageName);
            // Save the form data into the database
            $service = Service::create([

                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'image' => $imageName,

            ]);


            $user = Auth::user();
            $action = 'added_service';
            $description = 'Added a service: ' . $service->name;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return back()->with('success', 'Service added successfully.');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return a response
            return redirect()->back()->with('error', 'An error occurred while saving data');
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the doctor record
        $service = Service::findOrFail($id);

        // Soft delete the service
        $service->delete();

        $user = Auth::user();
        $action = 'delete_service';
        $description = 'Deleted service: ' . $service->name;
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        if ($request->has('status')) {
            $service->status = $request->status;
            $service->save();

            $user = Auth::user();
            $action = 'update_service';
            $description = 'Update a service status: ' . $service->name;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return redirect()->back()->with('success', 'Service status updated successfully.');
        }
        return redirect()->back()->with('error', 'No status provided.');
    }

    public function update(Request $request, $id)
{
    $service = Service::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'nullable|string',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jfif|max:2048'
    ]);

    $service->name = $request->name;
    $service->price = $request->price;
    $service->description = $request->description;

    // Handle image upload if new image is provided
    if ($request->hasFile('image')) {
        // Delete old image
        if ($service->image && file_exists(public_path('service_image/' . $service->image))) {
            unlink(public_path('service_image/' . $service->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('service_image'), $imageName);
        $service->image = $imageName;
    }

    $service->save();

    return redirect()->back()->with('success', 'Service updated successfully!');
}
}
