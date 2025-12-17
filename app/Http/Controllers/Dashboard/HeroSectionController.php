<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Http\Traits\FileTrait;

class HeroSectionController extends Controller
{
    use FileTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSection = HeroSection::first(); 
        return view('dashboard.hero.index', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
        ]);

        $heroSection = HeroSection::first();

        if($request->hasFile('image')) {
            $image = $this->deleteFile($heroSection['image'], 'public');
            $validated['image'] = $this->updateFile($request->file('image'), $heroSection->image, 'hero');
        }

        $heroSection->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image' => $validated['image'] ?? $heroSection['image'],
            ]);

        return redirect()->back()->with('success', 'Hero section updated successfully.');
    }
}
