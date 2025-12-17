<?php

namespace App\Http\Controllers\Dashboard\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Projects\ProjectCategory;

class ProjectCategoryController extends Controller
{
    public function create()
    {
        return view('dashboard.projects.category-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:project_categories,slug',
            'is_active' => 'nullable|in:on',
        ]);

        ProjectCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('projects.index')->with('success', 'تم إضافة التصنيف بنجاح.');
    }

    public function edit($id)
    {
        $category = ProjectCategory::findOrFail($id);
        return view('dashboard.projects.category-edit', compact('category'));
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:project_categories,slug,' . $request->category_id,
            'is_active' => 'nullable|in:on',
        ]);

        $category = ProjectCategory::findOrFail($request->category_id);
        // return $category;
        
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('projects.index')->with('success', 'تم تحديث التصنيف بنجاح.');
    }

    public function destroy($id)
    {
        $category = ProjectCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('projects.index')->with('success', 'تم حذف التصنيف بنجاح.');
    }
}