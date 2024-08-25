<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::paginate(8);
        return view('backend.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogs = Blog::all();
        $users = User::all();
        return view('backend.reviews.create', compact('blogs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250|min:10',
            'description' => 'required|string|max:500|min:10',
            'rating' => 'required|numeric|max:5|min:0',
        ]);
        $review = new Review();
        $review->user_id = $request->user_id;
        $review->user_name = User::findOrFail($request->user_id)->name;
        $review->blog_id = $request->blog_id;
        $review->title = $request->title;
        $review->description = $request->description;
        $review->rating = $request->rating;
        $review->approved = $request->approved;

        $review->save();
        return redirect()->route('admin.reviews.index')->with('success', 'Review saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $blogs = Blog::all();
        $users = User::all();
        return view('backend.reviews.edit', compact('blogs', 'users', 'review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:250|min:10',
            'description' => 'required|string|max:500|min:10',
            'rating' => 'required|numeric|max:5|min:0',
        ]);
        $review->user_id = $request->user_id;
        $review->user_name = User::findOrFail($request->user_id)->name;
        $review->blog_id = $request->blog_id;
        $review->title = $request->title;
        $review->description = $request->description;
        $review->rating = $request->rating;
        $review->approved = $request->approved;

        $review->save();
        return redirect()->route('admin.reviews.index')->with('success', 'Review updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted!');
    }



        /**
     * Store a newly created resource in storage.
     */
    public function storeFromFront(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250|min:10',
            'description' => 'required|string|max:500|min:10',
            'rating' => 'required|numeric|max:5|min:0',
        ]);
        $review = new Review();
        $review->user_id = $request->user_id;
        $review->user_name = $request->user_name;
        $review->blog_id = $request->blog_id;
        $review->title = $request->title;
        $review->description = $request->description;
        $review->rating = $request->rating;

        $result = $review->save();
        if($result){
            return 'Review saved! An admin will approve it later!';
        }else{
            return 'Review could not be saved! Please Contact us!';
        }

    }



}
