<?php

namespace App\Http\Controllers\Dashboard\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogCategory;


class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')->latest()->paginate(10);
        return view('dashboard.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->get();
        return view('dashboard.blog.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'content' => 'required',
            'author' => 'nullable',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        BlogPost::create($data);
        return redirect()->route('posts.index')->with('success', 'تم إضافة المقال بنجاح');
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::active()->get();
        return view('dashboard.blog.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'content' => 'required',
            'author' => 'nullable',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('success', 'تم تعديل المقال بنجاح');
    }

    public function destroy(BlogPost $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'تم حذف المقال');
    }
}
