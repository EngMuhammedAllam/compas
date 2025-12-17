<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\AboutPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    public function edit()
    {
        $about = AboutSection::firstOrNew();
        $points = AboutPoint::where('about_section_id', $about->id)->get();
        return view('dashboard.about.edit', compact('about', 'points'));
    }

    public function update(Request $request)
    {
        $about = AboutSection::firstOrNew();

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'image1' => 'nullable|image',
            'image2' => 'nullable|image',
            'image3' => 'nullable|image',
        ]);

        if ($request->hasFile('image1')) {
            if ($about->image1) Storage::disk('public')->delete($about->image1);
            $data['image1'] = $request->file('image1')->store('about', 'public');
        }
        if ($request->hasFile('image2')) {
            if ($about->image2) Storage::disk('public')->delete($about->image2);
            $data['image2'] = $request->file('image2')->store('about', 'public');
        }
        if ($request->hasFile('image3')) {
            if ($about->image3) Storage::disk('public')->delete($about->image3);
            $data['image3'] = $request->file('image3')->store('about', 'public');
        }

        $about->fill($data)->save();

        return redirect()->back()->with('success', 'About section updated successfully.');
    }

    public function storePoint(Request $request)
    {
        $request->validate(['text' => 'required|string']);
        $about = AboutSection::first();
        if (!$about) return redirect()->back()->with('error', 'Please save about section first');

        AboutPoint::create([
            'about_section_id' => $about->id,
            'text' => $request->text
        ]);
        return redirect()->back()->with('success', 'Point added successfully');
    }

    public function destroyPoint($id)
    {
        AboutPoint::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Point deleted successfully');
    }
}
