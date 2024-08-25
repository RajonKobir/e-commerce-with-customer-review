<?php

namespace App\Http\Controllers;

use App\Models\SocialLinks;
use Illuminate\Http\Request;

class SocialLinksController extends Controller
{
    //view social_links
    public function index()
    {
        $social_links = SocialLinks::all()->keyBy('slug');
        return view('backend.social_links', compact('social_links'));
    }

    //update social_link
    public function update(Request $request, SocialLinks $social_link)
    {
        $request->validate([
            'url' => 'url',
            'isActive' => 'boolean'
        ]);

        $social_link->url = $request->url;
        $social_link->isActive = $request->has('isActive');
        $social_link->save();
        return redirect()->route('admin.social.index')->with(['success' => 'Your Social Link has been updated']);
    }
}
