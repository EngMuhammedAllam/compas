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
        $counters = Counter::take(4)->get();
        $clients = \App\Models\Client::latest()->get();
        $features = Feature::get();

        // Service data
        $serviceSection = ServiceSection::active();
        $services = $serviceSection ? $serviceSection->services()->active()->ordered()->get() : collect([]);

        // Project data
        $projectSection = ProjectSection::first();
        $projectcategories = ProjectCategory::with('images')->get();

        // Testimonials
        $testimonialSection = SectionTestimonial::where('is_active', 1)->first();
        $testimonials = $testimonialSection
            ? $testimonialSection->testimonials()->active()->orderBy('sort_order', 'asc')->get()
            : collect([]);

        // Blog posts - cache for 30 minutes
        $posts = cache()->remember('homepage_blog_posts', 60, function () {
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
