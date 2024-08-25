<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $brands = Brand::paginate(25);
        return view('backend.brands.index', compact('brands'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('backend.brands.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:brands|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $brand = new Brand();
        $brand->title = $request->title;
        $brand->image = uploadImage($request->image);
        $brand->save();

        return redirect()->route('admin.brand.index')
                        ->with('success','Brand created successfully.');
    }

    // Display the specified resource.
    public function show(Brand $brand)
    {
        return view('brands.show',compact('brand'));
    }

    // Show the form for editing the specified resource.
    public function edit(Brand $brand)
    {
        return view('backend.brands.edit',compact('brand'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'title' => 'required|unique:brands,title,'.$brand->id.'|max:255',
            'image' => 'image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $brand->title = $request->title;

        if ($request->hasFile('image')) {
            deleteImage($brand->image);
            $brand->image = uploadImage($request->image);
        }

        $brand->save();

        return redirect()->route('admin.brand.index')
                        ->with('success','Brand updated successfully');
    }

    // Remove the specified resource from storage.
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brand.index')
                        ->with('success','Brand deleted successfully');
    }
}
