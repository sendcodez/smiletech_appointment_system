<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Dentist;
use App\Models\Service;
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
