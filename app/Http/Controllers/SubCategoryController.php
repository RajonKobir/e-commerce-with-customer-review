<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::paginate(25);
        return view('backend.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:sub_categories,name',
        ]);

        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = slugify($request->name, 'sub_categories');
        $subcategory->save();
        return redirect()->route('admin.subcat.index')->with('success', 'SubCategory saved!');
    }

    public function show(SubCategory $subcategory)
    {
        return view('backend.subcategories.show', compact('subcategory'));
    }

    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();
        return view('backend.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:sub_categories,name',
        ]);

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = slugify($request->name, 'sub_categories');

        $subcategory->save();
        return redirect()->route('admin.subcat.index')->with('success', 'SubCategory updated!');
    }

    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.subcat.index')->with('success', 'SubCategory deleted!');
    }
}
