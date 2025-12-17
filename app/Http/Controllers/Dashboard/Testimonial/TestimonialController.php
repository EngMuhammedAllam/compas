<?php

namespace App\Http\Controllers\Dashboard\Testimonial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonials\Testimonial;
use PHPUnit\Metadata\Test;
use App\Http\Requests\TestimonialRequest;

class TestimonialController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.testimonials.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validated();

        // Create a new Testimonial record
        Testimonial::create([
            'name' => $validatedData['name'],
            'message' => $validatedData['message'],
            'position' => $validatedData['position'] ?? null,
            'sort_order' => $validatedData['sort_order'] ?? 0,
            'section_testimonial_id' => 1, // Assuming testimonials belong to section with ID 1
            'active' => isset($validatedData['is_active']) && $validatedData['is_active'] === 'on' ? 1 : 0,
        ]);

        // Redirect back with a success message
        return redirect()->route('section_testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);    
        return view('dashboard.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request,$id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->update([
            'name' => $request->name,
            'message' => $request->message,
            'position' => $request->position,
            'sort_order' => $request->sort_order,
            'active' => isset($request->is_active) && $request->is_active === 'on' ? 1 : 0
        ]);
        
        return redirect()->route('section_testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('section_testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
