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
use App\Models\Counter;
use App\Models\ContactSetting;
use App\Models\AboutSection;
use App\Models\CtaSection;


class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cache static/semi-static data for 1 hour
        $seo = cache()->remember('seo_settings', 120, fn() => \App\Models\SeoSetting::first());
        $contactSetting = cache()->remember('contact_settings', 60, fn() => ContactSetting::first());
        $heroSection = HeroSection::first();
        $aboutSection = AboutSection::with('points')->first();
        $ctaSection = cache()->remember('cta_section', 60, fn() => CtaSection::first());
        $blogSection = cache()->remember('blog_section', 60, fn() => \App\Models\Blog\BlogSection::first());

        // Frequently changing data - no cache
        // Frequently changing data - cache for 10 minutes
        $counters = cache()->remember('landing_counters', 600, fn() => Counter::take(4)->get());
        $clients = cache()->remember('landing_clients', 600, fn() => \App\Models\Client::latest()->get());
        $features = cache()->remember('landing_features', 3600, fn() => Feature::get());

        // Service data - cache for 1 hour
        $services = cache()->remember('landing_services', 3600, function () {
            $serviceSection = ServiceSection::active();
            return $serviceSection ? $serviceSection->services()->active()->ordered()->get() : collect([]);
        });

        // Pass $serviceSection separately if needed by view, but usually view iterates $services. 
        // Logic preservation: The original code fetched $serviceSection then got services. 
        // We need to make sure $serviceSection is available if the view uses it.
        // Re-reading original code: $serviceSection was assigned.
        $serviceSection = cache()->remember('landing_service_section', 3600, fn() => ServiceSection::active());

        // Project data - cache for 1 hour
        $projectSection = cache()->remember('landing_project_section', 3600, fn() => ProjectSection::first());
        $projectcategories = cache()->remember('landing_project_categories', 3600, fn() => ProjectCategory::with('images')->get());

        // Testimonials - cache for 1 hour
        $testimonials = cache()->remember('landing_testimonials', 3600, function () {
            $testimonialSection = SectionTestimonial::where('is_active', 1)->first();
            return $testimonialSection
                ? $testimonialSection->testimonials()->active()->orderBy('sort_order', 'asc')->get()
                : collect([]);
        });
        // Also cache the section itself if used
        $testimonialSection = cache()->remember('landing_testimonial_section', 3600, fn() => SectionTestimonial::where('is_active', 1)->first());

        // Blog posts - cache for 30 minutes
        $posts = cache()->remember('homepage_blog_posts', 1800, function () {
            return BlogPost::with('category')
                ->active()
                ->published()
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();
        });

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
        $post = BlogPost::with('category')->active()->published()->findOrFail($id);

        // Increment views
        $post->increment('views');

        // Related posts
        $relatedPosts = BlogPost::where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->active()
            ->published()
            ->take(3)
            ->get();

        // Categories
        $categories = cache()->remember('blog_categories', 1800, fn() => BlogCategory::active()->get());

        // SEO data
        $seo = cache()->remember('seo_settings', 3600, fn() => \App\Models\SeoSetting::first());

        return view('landing.blogs.single_blog', compact('post', 'relatedPosts', 'categories', 'seo'));
    }

    public function showBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        $posts = BlogPost::where('blog_category_id', $id)
            ->active()
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $categories = cache()->remember('blog_categories', 1800, fn() => BlogCategory::active()->get());
        $seo = cache()->remember('seo_settings', 3600, fn() => \App\Models\SeoSetting::first());

        return view('landing.blogs.category', compact('posts', 'category', 'categories', 'seo'));
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
