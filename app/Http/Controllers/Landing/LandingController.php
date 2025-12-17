<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\Feature;
use App\Models\Projects\Project;
use App\Models\Projects\ProjectCategory;
use App\Models\Service\Service;
use App\Models\Service\ServiceSection;
use App\Models\Projects\ProjectSection;
use App\Models\Testimonials\SectionTestimonial;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogCategory;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        $heroSection = HeroSection::first();

        $features = Feature::get();
        $sectionServices = ServiceSection::first();
        $projectSection  = ProjectSection::first();
        $projectcategories   = ProjectCategory::with('images')->active()->get();
        $serviceSection = ServiceSection::active();
        $services = $serviceSection->services()->active()->ordered()->get();  
        $testimonialSection = SectionTestimonial::where('is_active', 1)->first();
        $testimonials = $testimonialSection
            ? $testimonialSection->testimonials()->active()->orderBy('sort_order', 'asc')->get()
            : collect([]);    
        $posts = BlogPost::with('category')
            ->active()
            ->published()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get(); 
         return view('landing.index', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showSingleBlog($id)
    {
        $post = BlogPost::with('category')->findOrFail($id);

        // زيادة عدد المشاهدات
        $post->increment('views');

        // مقالات ذات صلة
        $relatedPosts = BlogPost::where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->active()
            ->published()
            ->take(3)
            ->get();

        // الفئات
        $categories = BlogCategory::active()->get();

        return view('landing.blogs.single_blog', compact('post', 'relatedPosts', 'categories'));
    }

    public function showBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        $posts = BlogPost::where('blog_category_id', $id)
            ->active()
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        $categories = BlogCategory::active()->get();
        return view('landing.blogs.category', compact('posts', 'category', 'categories'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
