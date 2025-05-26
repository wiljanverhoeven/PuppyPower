<?php

namespace App\Http\Controllers;

use App\Models\Mytraining;
use Illuminate\Http\Request;

class MytrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Redirect if not logged in
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Fetch user trainings
        $mytrainings = auth()->user()->trainings;
        return view('mytrainings', compact('mytrainings'));
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
