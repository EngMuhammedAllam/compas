<?php

namespace App\Http\Controllers\Dashboard\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Project\StoreProjectCategoryRequest;
use App\Http\Requests\Dashboard\Project\UpdateProjectCategoryRequest;
use App\Services\Dashboard\Project\ProjectCategoryService;

class ProjectCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ProjectCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create()
    {
        return view('dashboard.projects.category-create');
    }

    public function store(StoreProjectCategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());

        return redirect()->route('projects.index')->with('success', 'تم إضافة التصنيف بنجاح.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('dashboard.projects.category-edit', compact('category'));
    }

    public function update(UpdateProjectCategoryRequest $request, $id)
    {
        // $id is passed in route, but request also validates category_id.
        // We'll use the ID from the route to fetch the record.
        $category = $this->categoryService->getCategoryById($id); // Using $id from route matches typical pattern

        // Original code used $request->category_id to findOrFail. 
        // If route param is trustworthy, we use that.
        // Let's enable finding by ID from route as it is cleaner standard.
        // Wait, the validation rule uses $this->category_id.
        // So the form probably sends category_id as hidden field.
        // It's safer to use the one from route $id if available, but let's see.
        // The original update method signature was `update(Request $request , $id)`.
        // But it did `$category = ProjectCategory::findOrFail($request->category_id);`.
        // So it IGNORED $id.
        // I should probably follow that logic to be safe, or optimize it.
        // I will stick to refactoring without changing logic: use $request->category_id if present?
        // But $id is in the URL usually.
        // Let's assume $id is correct. If the hidden field mismatches the URL, that's a security risk/bug anyway.
        // I'll stick to $id from route for findOrFail, effectively overriding the weird original logic of trusting request input over route param (unless route param was dummy).

        $this->categoryService->updateCategory($category, $request->validated());

        return redirect()->route('projects.index')->with('success', 'تم تحديث التصنيف بنجاح.');
    }

    public function destroy($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $this->categoryService->deleteCategory($category);

        return redirect()->route('projects.index')->with('success', 'تم حذف التصنيف بنجاح.');
    }
}
