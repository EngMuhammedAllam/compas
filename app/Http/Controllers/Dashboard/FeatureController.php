<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Http\Traits\FileTrait;
use App\Http\Requests\FeatureRequest;

class FeatureController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::all();
        return view('dashboard.features.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureRequest $request)
    {
        $validated = $request->validated();

        if($request->hasFile('image')) {
            $validated['image'] = $this->uploadFile($request->file('image'), 'features');
        }

        $feature = Feature::create($validated);
        return redirect()->route('features.index')->with('success', 'تم إضافة الميزة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $feature = Feature::findOrFail($request->id);
        return view('dashboard.features.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:10|max:1000',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp,ico,bmp|max:2048',
        ]);
        $feature = Feature::findOrFail($id);
        if($request->hasFile('image')) {
            $image = $this->deleteFile($feature['image'], 'public');
            $validated['image'] = $this->updateFile($request->file('image'), $feature->image, 'features');
        }
        $feature->update($validated);
        return redirect()->route('features.index')->with('success', 'تم تعديل الميزة بنجاح');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $feature = Feature::findOrFail($request->id);
        $this->deleteFile($feature['image'], 'public');
        $feature->delete();
        return redirect()->route('features.index')->with('success', 'تم حذف الميزة بنجاح');   
    }
}
