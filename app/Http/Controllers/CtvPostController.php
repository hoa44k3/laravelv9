<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
class CtvPostController extends Controller
{
     // Danh sách bài viết
     public function index()
     {
         $posts = Blog::where('user_id', auth()->id())->get();
         return view('ctv.posts.index', compact('posts'));
     }
 
     // Hiển thị form tạo bài viết
     public function create()
     {
         return view('ctv.posts.create');
     }
 
     // Lưu bài viết
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required|max:255',
             'content' => 'required',
         ]);
 
         Blog::create([
             'title' => $request->title,
             'content' => $request->content,
             'user_id' => auth()->id(),
             'status' => 'pending', // Mặc định chờ duyệt
         ]);
 
         return redirect()->route('ctv.posts.index')->with('success', 'Bài viết đã được gửi duyệt.');
     }
 
     // Hiển thị form sửa bài viết
     public function edit($id)
     {
         $post = Blog::where('user_id', auth()->id())->findOrFail($id);
         return view('ctv.posts.edit', compact('post'));
     }
 
     // Cập nhật bài viết
     public function update(Request $request, $id)
     {
         $request->validate([
             'title' => 'required|max:255',
             'content' => 'required',
         ]);
 
         $post = Blog::where('user_id', auth()->id())->findOrFail($id);
         $post->update($request->all());
 
         return redirect()->route('ctv.posts.index')->with('success', 'Bài viết đã được cập nhật.');
     }
 
     // Xóa bài viết
     public function destroy($id)
     {
         $post = Blog::where('user_id', auth()->id())->findOrFail($id);
         $post->delete();
 
         return redirect()->route('ctv.posts.index')->with('success', 'Bài viết đã được xóa.');
     }
}
