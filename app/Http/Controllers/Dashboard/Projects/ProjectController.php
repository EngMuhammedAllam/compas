<?php

namespace App\Http\Controllers\Dashboard\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Projects\ProjectCategory;
use App\Models\Projects\ProjectSection;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = ProjectSection::where('is_active', true)->first();
        $categories = ProjectCategory::with('images')->get();
        return view('dashboard.projects.index', get_defined_vars());
    }

}
