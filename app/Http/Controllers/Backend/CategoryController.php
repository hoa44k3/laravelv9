<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('comments')->get();
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // if ($request->hasFile('image')) {
        //     $data['image_path'] = $request->file('image')->store('categories', 'public');
        // }

        // Category::create($data);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image') ? $request->file('image')->store('categories', 'public') : null;

        Category::create([
            'name' => $validated['name'],
            'image_path' => $path,
        ]);
        return redirect()->route('backend.category.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $category = Category::findOrFail($category);
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return redirect()->route('backend.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category);
        $category->delete();
        return redirect()->route('backend.category.index')->with('success', 'Category deleted successfully.');
    }
    public function show($id)
    {
        $category = Category::with('blogs')->findOrFail($id); // Tải category cùng với các bài viết liên quan
        return view('backend.category.show', compact('category'));
    }
}
