<?php

namespace App\Http\Controllers\Dashboard\Service;

use App\Models\Service\ServiceSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $serviceSection = ServiceSection::first();
    $services = $serviceSection?->services()->latest()->get();

    return view('dashboard.services.index', get_defined_vars());
}


     /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $serviceSection = ServiceSection::findOrFail($id);
        return view('dashboard.services.section-service-edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $serviceSection = ServiceSection::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $serviceSection->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('section_services.index')->with('success', 'تم تحديث قسم الخدمات بنجاح.');
    }
}
