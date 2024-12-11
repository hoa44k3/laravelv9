<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
class CtvPostController extends Controller
{
     public function index()
     {
         $posts = Blog::where('user_id', auth()->id())->get();
         return view('ctv.posts.index', compact('posts'));
     }

     public function create()
     {
         return view('ctv.posts.create');
     }
 
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
             'status' => 'pending', 
         ]);
 
         return redirect()->route('ctv.posts.index')->with('success', 'Bài viết đã được gửi duyệt.');
     }
 
     public function edit($id)
     {
         $post = Blog::where('user_id', auth()->id())->findOrFail($id);
         return view('ctv.posts.edit', compact('post'));
     }
 
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
 
     public function destroy($id)
     {
         $post = Blog::where('user_id', auth()->id())->findOrFail($id);
         $post->delete();
 
         return redirect()->route('ctv.posts.index')->with('success', 'Bài viết đã được xóa.');
     }
}
