<?php

namespace App\Http\Controllers;

use App\Models\Mytraining;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Mymodule;
use App\Models\Training;

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
        $mytrainings = auth()->user()->mytrainings()->with(['training.modules'])->get();
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

    /**
     * Start a training session.
     */
    public function startTraining($id)
    {
        // safeguard if not logged in
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // safeguard if training isn't bought
        $training = Mytraining::findOrFail($id);

        if (!auth()->user()->mytrainings->contains($training)) {
            return redirect()->route('mytrainings')->with('error', 'Not allowed.');
        }

        // safeguard if module already exists ( AI query )
        if ($training->status === 'started') {
            $modules = Mymodule::where('user_id', auth()->id())
                ->where('mytraining_id', $training->mytraining_id)
                ->whereHas('module', function ($query) use ($training) {
                    $query->where('training_id', $training->training_id);
                })
                ->get();

            return view('activetraining', [
                'modules' => $modules,
            ])->with('success', 'Training already started.');
        }

        // Fetch and store modules to mymodules
        $modules = Module::where('training_id', $training->training_id)->get();

        foreach ($modules as $module) {
            Mymodule::firstOrCreate([
                'user_id' => auth()->id(),
                'module_id' => $module->module_id,
                'mytraining_id' => $training->mytraining_id,
            ]);
        }

        // Update training status
        $training->update(['status' => 'started']);

        // Switch to active training view ( AI query )
        $modules = Mymodule::where('user_id', auth()->id())
            ->where('mytraining_id', $training->mytraining_id)
            ->whereHas('module', function ($query) use ($training) {
                $query->where('training_id', $training->training_id);
            })
            ->get();

        return view('activetraining', [
            'modules' => $modules,
        ])->with('success', 'Training already started.');
    }

    /**
     * Update the status of a module.
     */
    public function updateModuleStatus($id)
    {
        $mymodule = Mymodule::findOrFail($id);

        if ($mymodule->user_id !== auth()->id()) {
            return redirect()->route('mytrainings')->with('error', 'Not allowed.');
        }

        // Change module status to completed
        if ($mymodule->status !== 'completed') {
            $mymodule->update(['status' => 'completed']);
        }

        return redirect()->route('mytrainings.startTraining', $mymodule->mytraining_id)
            ->with('success', 'Module completed.');
    }

    /**
     * Start a module
     */
    public function startModule($id)
    {
        $mymodule = Mymodule::findOrFail($id);

        if ($mymodule->user_id !== auth()->id()) {
            return redirect()->route('mytrainings')->with('error', 'Not allowed.');
        }

        // Change module status to started
        if ($mymodule->status !== 'completed') {
            $mymodule->update(['status' => 'started']);
        }

        return view('trainingmodule', [
            'mymodule' => $mymodule,
        ])->with('success', 'Module started.');
    }
}
