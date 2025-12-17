<?php

namespace App\Http\Controllers\Dashboard\Testimonial;

use App\Http\Requests\StoreSectionTestimonialRequest;
use App\Http\Requests\UpdateSectionTestimonialRequest;
use App\Http\Controllers\Controller;
use App\Models\Testimonials\SectionTestimonial;
use App\Models\Testimonials\Testimonial;

class SectionTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectionTestimonial = SectionTestimonial::first();
        $testimonials = $sectionTestimonial->testimonials()->latest()->get();
        return view('dashboard.testimonials.index', compact('sectionTestimonial', 'testimonials'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionTestimonial $sectionTestimonial)
    {
        $sectionTestimonial = SectionTestimonial::first();
        return view('dashboard.testimonials.section-edit', compact('sectionTestimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionTestimonialRequest $request, SectionTestimonial $sectionTestimonial)
    {
        $sectionTestimonial->first()
        ->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->route('section_testimonials.index')->with('success', 'تم تحديث قسم الشهادات بنجاح.');
    }
}
