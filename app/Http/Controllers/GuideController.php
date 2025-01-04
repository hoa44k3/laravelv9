<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guide;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return view('guides.index', compact('guides'));
    }

    public function show($id)
    {
        $guide = Guide::findOrFail($id);
        return view('guides.show', compact('guide'));
    }

    public function create()
    {
        return view('guides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guide_images', 'public');
        }

        Guide::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('guides.index')->with('success', 'Hướng dẫn đã được thêm!');
    }

    public function edit($id)
    {
        $guide = Guide::findOrFail($id);
        return view('guides.edit', compact('guide'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $guide = Guide::findOrFail($id);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guide_images', 'public');
            $guide->image = $imagePath;
        }

        $guide->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('guides.index')->with('success', 'Hướng dẫn đã được cập nhật!');
    }

    public function destroy($id)
    {
        $guide = Guide::findOrFail($id);
        $guide->delete();

        return redirect()->route('guides.index')->with('success', 'Hướng dẫn đã được xóa!');
    }
}
