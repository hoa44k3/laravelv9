<?php

namespace App\Http\Controllers\Backend;
use App\Models\Like;
use App\Models\Blog;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
     // Hiển thị danh sách lượt thích
     public function index()
     {
         $likes = Like::with(['blog', 'user'])->get();
         return view('backend.likes.index', compact('likes'));
     }
 
     // Hiển thị form tạo lượt thích mới
     public function create()
     {
         $blogs = Blog::all();
         $users = User::all();
         return view('backend.likes.create', compact('blogs', 'users'));
     }
 
     // Lưu lượt thích mới
     public function store(Request $request)
     {
         $request->validate([
             'blog_id' => 'required|exists:blogs,id',
             'user_id' => 'required|exists:users,id',
         ]);
 
         Like::create($request->all());
         return redirect()->route('backend.likes.index')->with('success', 'Lượt thích được tạo thành công.');
     }
 
     // Hiển thị form sửa lượt thích
     public function edit($id)
     {
         $like = Like::findOrFail($id);
         $blogs = Blog::all();
         $users = User::all();
         return view('backend.likes.edit', compact('like', 'blogs', 'users'));
     }
 
     // Cập nhật lượt thích
     public function update(Request $request, $id)
     {
         $request->validate([
             'blog_id' => 'required|exists:blogs,id',
             'user_id' => 'required|exists:users,id',
         ]);
 
         $like = Like::findOrFail($id);
         $like->update($request->all());
         return redirect()->route('backend.likes.index')->with('success', 'Lượt thích được cập nhật thành công.');
     }
 
     // Xóa lượt thích
     public function destroy($id)
     {
         $like = Like::findOrFail($id);
         $like->delete();
         return redirect()->route('backend.likes.index')->with('success', 'Lượt thích đã bị xóa.');
     }
}
