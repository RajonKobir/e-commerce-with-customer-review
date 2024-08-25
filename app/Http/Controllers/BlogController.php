<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(25);
        return view('backend.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $subCategories = SubCategory::all();
        $tags = Tag::all();
        return view('backend.blogs.create', compact('tags', 'subCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'title' => 'required|string|max:250|min:10',
            'meta_title' => 'required|string|max:250|min:10',
            'meta_description' => 'required|string|max:500|min:10',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'body' => 'required',
            'download_link' => 'nullable|url',
            'direct_download' => 'boolean',
        ]);

        $blog = new Blog();
        $blog->sub_category_id = $request->sub_category_id;
        $blog->title = $request->title;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->body = $request->body;
        $blog->download_link = $request->download_link;
        $blog->direct_download = $request->has('direct_download');
        $blog->slug = slugify($request->title, 'blogs');
        $blog->image = uploadImage($request->image);

        $blog->save();
        $blog->tags()->attach($request->tags);
        return redirect()->route('admin.blog.index')->with('success', 'Blog saved!');
    }

    public function show(Blog $blog)
    {
        //count the  views of this blog and increment it by one
        return view('backend.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $subCategories = SubCategory::all();
        $tags = Tag::all();
        return view('backend.blogs.edit', compact('blog', 'tags', 'subCategories'));
    }

    public function update(Request $request, Blog $blog)
    {
        // dd($request->all());
        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'title' => 'required|string|max:250|min:10',
            'meta_title' => 'required|string|max:250|min:10',
            'meta_description' => 'required|string|max:500|min:10',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'body' => 'required',
            'download_link' => 'nullable|url',
            'direct_download' => 'boolean'
        ]);

        $blog->sub_category_id = $request->sub_category_id;
        $blog->title = $request->title;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->body = $request->body;
        $blog->download_link = $request->download_link;
        $blog->direct_download = $request->has('direct_download');

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->extension();
        //     $image->move(public_path('images'), $imageName);
        //     $blog->image = $imageName;
        // }

        if ($request->hasFile('image')) {
            deleteImage($blog->image);
            $blog->image = uploadImage($request->image);
        }

        $blog->save();
        $blog->tags()->sync($request->tags);
        return redirect()->route('admin.blog.index')->with('success', 'Blog updated!');
    }

    public function destroy(Blog $blog)
    {
        deleteImage($blog->image);
        $blog->tags()->detach();
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted!');
    }

    // A Method to Search Blogs for Admin
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:3',
        ]);

        $blogs = Blog::where('title', 'like', '%' . $request->search . '%')
            ->orWhere('body', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(25);

        return view('backend.blogs.index', compact('blogs'));
    }
}
