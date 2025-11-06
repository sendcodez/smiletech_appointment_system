<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Dentist;
use App\Models\Service;
use App\Models\Faq;
use App\Models\FaqCategory;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dentists = Dentist::where('status', 1)->get();
        $services = Service::where('status', 1)->get(); // Fetch active services
        $website = Website::first();
        return view('index', compact('website','services','dentists'));
    }
    public function about()
    {
        $dentists = Dentist::where('status', 1)->get();
        $services = Service::where('status', 1)->get(); // Fetch active services
        $website = Website::first();
        return view('about', compact('website','services','dentists'));
    }
    public function services()
    {
        $dentists = Dentist::where('status', 1)->get();
        $services = Service::where('status', 1)->get(); // Fetch active services
        $website = Website::first();
        return view('services', compact('website','services','dentists'));
    }
    public function dentist()
    {
        $dentists = Dentist::where('status', 1)->get();
        $services = Service::where('status', 1)->get(); // Fetch active services
        $website = Website::first();
        return view('dentist', compact('website','services','dentists'));
    }



    public function faq_public(Request $request)
{
    $website = Website::first();
    $search = $request->input('search');
    $category = $request->input('category');

    // Query FAQs with status = 1, and apply filters if provided
    $faq = Faq::where('status', 1)
        ->when($search, function ($query, $search) {
            return $query->where('question', 'like', '%' . $search . '%');
        })
        ->when($category, function ($query, $category) {
            return $query->where('faq_category_id', $category);
        })
        ->get();

    // Fetch all categories for the category filter
    $categories = FaqCategory::all();

    return view('faq', compact('faq', 'categories','website'));
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
