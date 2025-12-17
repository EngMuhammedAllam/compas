<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FeatureController;
use App\Http\Controllers\Dashboard\HeroSectionController;
use App\Http\Controllers\Dashboard\Service\ServiceController;
use App\Http\Controllers\Dashboard\Projects\ProjectController;
use App\Http\Controllers\Dashboard\Projects\ProjectCategoryController;
use App\Http\Controllers\Dashboard\Projects\ProjectImageController;
use App\Http\Controllers\Dashboard\Projects\ProjectSectionController;
use App\Http\Controllers\Dashboard\Service\ServiceSectionController;
use App\Http\Controllers\Dashboard\Testimonial\TestimonialController;
use App\Http\Controllers\Dashboard\Testimonial\SectionTestimonialController;
use App\Http\Controllers\Dashboard\Blog\BlogController;

//  ========================================== Default Redirect ==========================================
    
    Route::get('/' , [LandingController::class , 'index' ])->name('landing');
    Route::get('/blog/{id}', [LandingController::class, 'showSingleBlog'])->name('blog.show');
    Route::get('/blog/category/{id}', [LandingController::class, 'showBlogCategory'])->name('blog.category');
    Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.submit');

// ############################## [[== Admin ==]] Routes ################################### //
    Route::group([], function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

        // ############################ [Hero] Section Route ############################
        Route::get('/hero/edit', [HeroSectionController::class, 'index'])->name('admin.hero.edite');
        Route::post('/hero/update', [HeroSectionController::class, 'update'])->name('admin.hero.update');

        // ############################ [Features] Section Route ############################
        Route::get('features', [FeatureController::class, 'index'])->name('features.index');
        Route::get('features/create', [FeatureController::class, 'create'])->name('features.create');
        Route::post('features', [FeatureController::class, 'store'])->name('features.store');
        Route::get('features-edit/{id}', [FeatureController::class, 'edit'])->name('features.edit');
        Route::put('features/{id}', [FeatureController::class, 'update'])->name('features.update');
        Route::delete('features/{id}', [FeatureController::class, 'destroy'])->name('features.destroy');

        // ############################ [Projects] Section Route ############################
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects-section-edit', [ProjectSectionController::class, 'edit'])->name('admin.projects.section.edit');
        Route::put('/projects-section', [ProjectSectionController::class, 'update'])->name('admin.projects.section.update');

        Route::get('/projects-categories-create', [ProjectCategoryController::class, 'create'])->name('admin.projects.categories.create');
        Route::post('/projects-categories-store', [ProjectCategoryController::class, 'store'])->name('admin.projects.categories.store');
        Route::get('/projects-categories-edit/{id}', [ProjectCategoryController::class, 'edit'])->name('admin.projects.categories.edit');
        Route::put('/projects-categories-update/{id}', [ProjectCategoryController::class, 'update'])->name('admin.projects.categories.update');
        Route::delete('/projects-categories/{id}', [ProjectCategoryController::class, 'destroy'])->name('admin.projects.categories.destroy');

        Route::get('/projects-images-create/{id}', [ProjectImageController::class, 'create'])->name('admin.projects.images.create');
        Route::post('/projects-images', [ProjectImageController::class, 'store'])->name('admin.projects.images.store');
        Route::get('/projects-images-edit/{id}', [ProjectImageController::class, 'edit'])->name('admin.projects.images.edit');
        Route::put('/projects-images/{id}', [ProjectImageController::class, 'update'])->name('admin.projects.images.update');
        Route::delete('/projects-images/{id}', [ProjectImageController::class, 'destroy'])->name('admin.projects.images.destroy');

        // ############################ [Services] Section Route ############################
        Route::get('section-services', [ServiceSectionController::class , 'index'])->name('section_services.index');
        Route::get('section-services/{id}', [ServiceSectionController::class , 'edit'])->name('section_services.edit');
        Route::put('section-services/{id}', [ServiceSectionController::class , 'update'])->name('section_services.update'); 

        Route::get('services', [ServiceController::class , 'index'])->name('services.index');
        Route::get('services/create', [ServiceController::class , 'create'])->name('services.create');
        Route::post('services', [ServiceController::class , 'store'])->name('services.store');
        Route::get('services-edit/{id}', [ServiceController::class , 'edit'])->name('services.edit');
        Route::put('services/{id}', [ServiceController::class , 'update'])->name('services.update');
        Route::delete('services/{id}', [ServiceController::class , 'destroy'])->name('services.destroy');

        // ############################ [Testmonials] Section Route ############################
        Route::get('section-testmonials',       [SectionTestimonialController::class , 'index'])->name('section_testimonials.index');
        Route::get('section-testimonials/{id}', [SectionTestimonialController::class , 'edit'])->name('section_testimonials.edit');
        Route::put('section-testimonials/{id}', [SectionTestimonialController::class , 'update'])->name('section_testimonials.update'); 

        Route::get('testimonials', [TestimonialController::class , 'index'])->name('testimonials.index');
        Route::get('testimonials/create', [TestimonialController::class , 'create'])->name('testimonials.create');
        Route::post('testimonials', [TestimonialController::class , 'store'])->name('testimonials.store');
        Route::get('testimonials-edit/{id}', [TestimonialController::class , 'edit'])->name('testimonials.edit');
        Route::put('testimonials/{id}', [TestimonialController::class , 'update'])->name('testimonials.update');
        Route::delete('testimonials/{id}', [TestimonialController::class , 'destroy'])->name('testimonials.destroy');

        // ############################ [Contact] Section Route ############################
        // Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact.index');
        // Route::get('/contact-edit', [ContactController::class, 'edit'])->name('admin.contact.edit');
        // Route::put('/contact', [ContactController::class, 'update'])->name('admin.contact.update');


    });



?>