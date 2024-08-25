<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(25);
        return view('backend.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('backend.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100'
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = slugify($request->name, 'tags');
        $tag->save();
        return redirect()->route('admin.tag.index')->with('success', 'Tag saved!');
    }

    public function show(Tag $tag)
    {
        return view('backend.tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('backend.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:100'
        ]);
        $tag->name = $request->name;
        $tag->slug = slugify($request->name, 'tags');
        $tag->save();
        return redirect()->route('admin.tag.index')->with('success', 'Tag updated!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tag.index')->with('success', 'Tag deleted!');
    }
}
