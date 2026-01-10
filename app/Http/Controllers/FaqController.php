<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function faq_category()
    {
        $categories = FaqCategory::withCount('faqs')->get();
        return view('admin.faq_categories', compact('categories'));
    }
    public function faq()
    {
        $categories = FaqCategory::all();
        $faqs = FAQ::with('category')->get();
        return view('admin.faq', compact('categories', 'faqs'));
    }
    public function faq_patient(Request $request)
{
    $search = $request->input('search');
    $category = $request->input('category');

    // Query FAQs with status = 1, and apply filters if provided
    $faqs = Faq::where('status', 1)
        ->when($search, function ($query, $search) {
            return $query->where('question', 'like', '%' . $search . '%');
        })
        ->when($category, function ($query, $category) {
            return $query->where('faq_category_id', $category);
        })
        ->get();

    // Fetch all categories for the category filter
    $categories = FaqCategory::all();

    return view('patient.faq_patient', compact('faqs', 'categories'));
}


    public function faq_store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'faq_category_id' => 'required|string|max:255',
                'question' => 'required|string',
                'answer' => 'required|string',
            ]);

            // Save the form data into the database
            $faq = Faq::create([
                'faq_category_id' => $validatedData['faq_category_id'],
                'question' => $validatedData['question'],
                'answer' => $validatedData['answer'],
            ]);

            $user = Auth::user();
            $action = 'added_faq';
            $description = 'Added a faq: ' . $faq->question;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);

            return back()->with('success', 'Category added successfully.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error in faq_category_store: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Return error message for debugging
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }
    public function faq_category_store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            // Save the form data into the database
            $faq = FaqCategory::create([
                'name' => $validatedData['name'],
            ]);

            $user = Auth::user();
            $action = 'added_faq';
            $description = 'Added a category: ' . $faq->name;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);

            return back()->with('success', 'Category added successfully.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error in faq_category_store: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Return error message for debugging
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        // Find the doctor record
        $faq = Faq::findOrFail($id);

        // Soft delete the faq
        $faq->delete();

        $user = Auth::user();
        $action = 'delete_faq';
        $description = 'Deleted faq: ' . $faq->question;
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname,
            'action' => $action,
            'description' => $description,
        ]);
        return redirect()->back()->with('success', 'Faq deleted successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        if ($request->has('status')) {
            $faq->status = $request->status;
            $faq->save();

            $user = Auth::user();
            $action = 'update_faq';
            $description = 'Update a faq status: ' . $faq->status;
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname,
                'action' => $action,
                'description' => $description,
            ]);
            return redirect()->back()->with('success', 'Faq status updated successfully.');
        }
        return redirect()->back()->with('error', 'No status provided.');
    }


    public function faq_update(Request $request, $id)
{
    try {
        // Log the incoming request data
        \Log::info('FAQ Update Request', [
            'id' => $id,
            'data' => $request->all()
        ]);

        $faq = FAQ::findOrFail($id);
        
        $validatedData = $request->validate([
            'faq_category_id' => 'required',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq->faq_category_id = $validatedData['faq_category_id'];
        $faq->question = $validatedData['question'];
        $faq->answer = $validatedData['answer'];
        $faq->save();

        \Log::info('FAQ Updated Successfully', ['faq_id' => $faq->id]);

        // Log activity if you have activity logging
        if (class_exists('App\Models\ActivityLog')) {
            $user = Auth::user();
            ActivityLog::create([
                'user_id' => $user->id,
                'name' => $user->firstname ?? $user->name,
                'action' => 'updated_faq',
                'description' => 'Updated FAQ: ' . substr($faq->question, 0, 50),
            ]);
        }

        return redirect()->back()->with('success', 'FAQ updated successfully.');
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('FAQ Validation Error', ['errors' => $e->errors()]);
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput()
            ->with('error', 'Validation failed: ' . json_encode($e->errors()));
            
    } catch (\Exception $e) {
        \Log::error('FAQ Update Error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()
            ->withInput()
            ->with('error', 'Error: ' . $e->getMessage());
    }
}

public function faq_category_update(Request $request, $id)
{
    try {
        $category = FaqCategory::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:faq_category,name,' . $id,
        ]);

        $category->update([
            'name' => $validatedData['name'],
        ]);

        // Log activity if you have activity logging
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname ?? $user->name,
            'action' => 'updated_faq_category',
            'description' => 'Updated FAQ category: ' . $category->name,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

public function faq_category_destroy($id)
{
    try {
        $category = FaqCategory::findOrFail($id);
        
        // Check if category has FAQs
        if ($category->faqs()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category with existing FAQs. Please delete or reassign the FAQs first.');
        }

        $categoryName = $category->name;
        $category->delete();

        // Log activity
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
            'name' => $user->firstname ?? $user->name,
            'action' => 'deleted_faq_category',
            'description' => 'Deleted FAQ category: ' . $categoryName,
        ]);

        return redirect()->back()->with('success', 'Category deleted successfully.');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
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
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

}
