<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Blog;
class TagController extends Controller
{
    // Hiển thị danh sách tags
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    // Hiển thị form tạo tag
    public function create()
    {
        $blogs = Blog::select('id', 'title')->get();
        return view('tags.create', compact('blogs'));
        // return view('tags.create');
    }

    // Lưu tag mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    // Hiển thị chi tiết tag
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show', compact('tag'));
    }

    // Hiển thị form sửa tag
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    // Cập nhật tag trong cơ sở dữ liệu
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

    // Xóa tag
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}