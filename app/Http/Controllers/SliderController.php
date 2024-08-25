<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $sliders = Slider::paginate(25);
        return view('backend.sliders.index', compact('sliders'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('backend.sliders.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'description' => 'required|max:300',
            // 'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
            'image' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = uploadImage($request->image);
        $slider->save();

        return redirect()->route('admin.slider.index')
                        ->with('success','Slider created successfully.');
    }

    // Display the specified resource.
    public function show(Slider $slider)
    {
        return view('backend.sliders.show',compact('slider'));
    }

    // Show the form for editing the specified resource.
    public function edit(Slider $slider)
    {
        return view('backend.sliders.edit',compact('slider'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|unique:sliders,title,'.$slider->id.'|max:255',
            'description' => 'required|max:255',
            'image' => 'image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $slider->title = $request->title;
        $slider->description = $request->description;

        if ($request->hasFile('image')) {
            deleteImage($slider->image);
            $slider->image = uploadImage($request->image);
        }

        $slider->save();

        return redirect()->route('admin.slider.index')
                        ->with('success','Slider updated successfully');
    }

    // Remove the specified resource from storage.
    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('admin.slider.index')
                        ->with('success','Slider deleted successfully');
    }
}
