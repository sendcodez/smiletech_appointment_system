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
                'question' => 'required|string|max:255',
                'answer' => 'required|string|max:255',
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
