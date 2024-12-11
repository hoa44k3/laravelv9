<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Blog;
class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        $blogs = Blog::select('id', 'title')->get();
        return view('tags.create', compact('blogs'));
        // return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
