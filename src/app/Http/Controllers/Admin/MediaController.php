<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Module;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Training $training, Module $module)
    {
        $media = $module->media()->orderBy('order')->get();

        return view('admin.media.index', compact('training', 'module', 'media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Training $training, Module $module)
    {
        return view('admin.media.create', compact('training', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Training $training, Module $module)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'path' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:5000',
            'order' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $media = new Media();
        $media->title = $validated['title'] ?? null;
        $media->description = $validated['description'] ?? null;
        $media->order = $validated['order'];
        $media->module_id = $module->module_id;

        // check for image uploaded or take entered path
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('media_images', 'public');
            $media->path = 'storage/' . $imagePath; // Save img path

        } else {
            $media->path = $validated['path'] ?? null;
        }

        $media->save();

        return redirect()->route('trainings.modules.media.index', [$training, $module])->with('success', 'Media succesvol toegevoegd.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training, Module $module, Media $medium)
    {
        return view('admin.media.edit', compact('training', 'module', 'medium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training, Module $module, Media $medium)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'path' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:5000',
            'order' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // check for image uploaded or take entered path
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('media_images', 'public');
            $validated['path'] = 'storage/' . $imagePath;

            // delete old image
            if (!Str::startsWith($medium->path, 'http') && Storage::disk('public')->exists(str_replace('storage/', '', $medium->path))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $medium->path));
            }
        } else {
            if (empty($validated['path'])) {
                $validated['path'] = $medium->path;
            }
        }

        $medium->update($validated);

        return redirect()->route('trainings.modules.media.index', [$training, $module])->with('success', 'Media succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Took a while trying everything until I found out that you cant Media $media because laravel automatically recoginizes the singular form of the model name. In this case: Media $medium
     *
     */
    public function destroy(Training $training, Module $module, Media $medium)
    {
        // delete file if image
        if (!Str::startsWith($medium->path, 'http') && Storage::disk('public')->exists(str_replace('storage/', '', $medium->path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $medium->path));
        }

        $medium->delete();

        return redirect()->route('trainings.modules.media.index', [$training, $module])->with('success', 'Media succesvol verwijderd.');
    }

}
