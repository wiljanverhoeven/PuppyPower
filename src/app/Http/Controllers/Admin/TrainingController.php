<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Module;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::withCount('modules')->get();

        return view('admin.trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'date' => 'nullable|date',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $training = new Training();
        $training->name = $validated['name'];
        $training->description = $validated['description'];
        $training->date = $validated['date'] ?? null;
        $training->type = $validated['type'];
        $training->price = $validated['price'];
        $training->save();

        return redirect()->route('trainings.index')->with('success', 'Training created successfully!');
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
        $training = Training::findOrFail($id);

        return view('admin.trainings.edit', compact('training'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $training = Training::findOrFail($id);

        $training->update ($validated);

        return redirect()->route('trainings.index')->with('success', 'Training succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $training = Training::findOrFail($id);
        $training->delete();

        return redirect()->route('trainings.index')->with('success', 'Training succesvol verwijderd.');
    }
}
