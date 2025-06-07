<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Media;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Training $training)
    {
        $modules = $training->modules()->withCount('media')->get();

        return view('admin.modules.index', compact('training', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Training $training)
    {
        return view('admin.modules.create', compact('training'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Training $training)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'order' => 'required|numeric|min:0',
        ]);

        $module = new Module();
        $module->name = $validated['name'];
        $module->description = $validated['description'] ?? null;
        $module->order = $validated['order'];
        $module->training_id = $training->training_id;
        $module->save();

        return redirect()->route('trainings.modules.index', $training)->with('success', 'Module succesvol toegevoegd.');
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
    public function edit(Training $training, Module $module)
    {
        return view('admin.modules.edit', compact('module', 'training'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training, Module $module)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'order' => 'required|numeric|min:0',
        ]);

        $module->update($validated);

        return redirect()->route('trainings.modules.index', $training)->with('success', 'Module succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training, Module $module)
    {
        $module->delete();

        return redirect()->route('trainings.modules.index', $training)->with('success', 'Module succesvol verwijderd.');
    }
}
