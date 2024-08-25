<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(25);
        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $slug = slugify($request->get('name'), 'categories');
        $category = new Category([
            'name' => $request->get('name'),
            'slug' => $slug
        ]);
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Category saved!');
    }

    public function show($slug)
    {
        $category = Category::find($slug);
        return view('backend.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);
        $category->name = $request->get('name');
        $category->slug = slugify($request->get('name'), 'categories');
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Category updated!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted!');
    }
}
