<?php

namespace App\Http\Controllers\Dashboard\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use App\Http\Traits\FileTrait;
use App\Models\Service\ServiceSection;

class ServiceController extends Controller
{
    use FileTrait;

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|max:4096',
            'is_active' => 'nullable|in:on',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('icon')) {
            $iconPath = $this->uploadFile($request->file('icon'), 'services' , 'public');
            $validatedData['icon'] = $iconPath;
        }

        Service::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'icon' => $validatedData['icon'] ?? null,
            'is_active' => isset($validatedData['is_active']) && $validatedData['is_active'] === 'on' ? true : false,
            'sort_order' => $validatedData['sort_order'] ?? 0,
            'service_section_id' => ServiceSection::first()->id,
        ]);

        return redirect()->route('section_services.index')->with('success', 'تم اضافة الخدمة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $record = Service::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|max:2048',
            'is_active' => 'nullable|in:on',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('icon')) {
            // Delete old icon file if exists
            if ($record->icon) {
                $this->deleteFile($record->icon);
            }
            $iconPath = $this->uploadFile($request->file('icon'), 'services' , 'public');
            $validatedData['icon'] = $iconPath;
        }

        $record->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'icon' => $validatedData['icon'] ?? $record->icon,
            'is_active' => isset($validatedData['is_active']) && $validatedData['is_active'] === 'on' ? true : false,
            'sort_order' => $validatedData['sort_order'] ?? $record->sort_order,
        ]);
        
        return redirect()->route('section_services.index')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Service::findOrFail($id);
        
        // Delete associated icon file if exists
        if ($record->icon) {
            $this->deleteFile($record->icon);
        }

        $record->delete();
        return redirect()->route('section_services.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
