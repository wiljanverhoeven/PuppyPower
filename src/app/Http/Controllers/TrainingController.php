<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Module;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::withCount('modules')->get();
        $mytrainings = auth()->user() ? auth()->user()->mytrainings->pluck('training_id') : collect();

        return view('training', compact('trainings', 'mytrainings'));
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
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        //
    }

    /**
     * Buy and redirect to buy page.
     */
    public function buytraining($id)
    {
        $training = Training::withCount('modules')->findOrFail($id);
        return view('buytraining', compact('training'));
    }

    /**
     * Confirm purchase and redirect to confirmation page.
     */
    public function confirmPurchase(Request $request, $id)
    {

        $training = Training::findOrFail($id);

        // Save to mytrainings
        auth()->user()->mytrainings()->create([
            'training_id' => $training->training_id,
            'status' => 'open',
        ]);

        return redirect()->route('trainings')->with('success', 'success');
    }
}
