<?php

namespace App\Http\Controllers\Dashboard\Projects;

use App\Models\Projects\ProjectCategory;
use App\Models\Projects\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProjectImageController extends Controller
{
    public function create($id)
    {
        $category = ProjectCategory::findOrFail($id);
        return view('dashboard.projects.image-create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:project_categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $imagePath = $request->file('image')->storeAs(
            'projects',
            time() . '_' . $request->file('image')->getClientOriginalName(),
            'public'
        );

        ProjectImage::create([
            'category_id' => $request->category_id,
            'image' => basename($imagePath),
            'title' => $request->title,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('projects.index')->with('success', 'تم إضافة الصورة بنجاح.');
    }

    public function edit($id)
    {
        $image = ProjectImage::findOrFail($id);
        return view('dashboard.projects.image-edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = ProjectImage::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string',
            'sort_order' => 'integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            Storage::disk('public')->delete('projects/' . $image->image);
            $imagePath = $request->file('image')->storeAs(
                'projects',
                time() . '_' . $request->file('image')->getClientOriginalName(),
                'public'
            );
            $data['image'] = basename($imagePath);
        }

        $image->update($data);

        return redirect()->route('projects.index')->with('success', 'تم تحديث الصورة بنجاح.');
    }

    public function destroy($id)
    {
        $image = ProjectImage::findOrFail($id);
        Storage::disk('public')->delete('projects/' . $image->image);
        $image->delete();

        return redirect()->route('projects.index')->with('success', 'تم حذف الصورة بنجاح.');
    }
}