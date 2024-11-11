<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogAdminController extends Controller
{
    public function home()
    {
        $blogs = Blog::with('user', 'category')->withCount('likes')->get();
        return view('blogs.home', compact('blogs'));
    }
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('blogs.create', compact('categories','users')); 
    }
    public function store(Request $request)
    {
        $create = new Blog();
        $create->title = $request->title;
        $create->content = $request->content;   
        $create->status =$request->status;
        $create->likes = $request->likes;
        $create->comment_count = $request->comment_count;   
        $create->user_id =$request->user_id;
        $create->category_id = $request->category_id;   
        
        if ($request->hasFile('image_path')) {
            $image_path = $request->file('image_path')->store('blogs', 'public');
            $create->image_path = $image_path; 
        }
        $create->save();
        return redirect()->route('blogs.home')->with('success', 'Bài viết đã được tạo thành công!');
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        $users = User::all();
        return view('blogs.edit', compact('blog', 'categories','users'));
    }

    public function update(Request $request, $id)
    {
        $edit = Blog::find($id);
        $edit->title = $request->title;
        $edit->content = $request->content;  
        $edit->status = $request->status;
        $edit->likes = $request->likes;  
        $edit->comment_count = $request->comment_count;  
        $edit->user_id = $request->user_id;
        $edit->category_id = $request->category_id;  
        $edit->save();
    if ($request->hasFile('image_path')) {
        if ($edit->image_path) {
            Storage::disk('public')->delete($edit->image_path);
        }
        $edit->image_path = $request->file('image_path')->store('blog', 'public');
    }
        return redirect()->route('blogs.home')->with('success', 'Bài viết đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

    if ($blog->image_path) {
        Storage::disk('public')->delete($blog->image_path);
    }

    $blog->delete();

    return response()->json(['success' => 'Bài viết đã được xóa thành công.']);
    }
    public function statistics()
    {
        $totalBlogs = Blog::count();
        $approvedBlogs = Blog::where('status', 'approved')->count();
        $pendingBlogs = Blog::where('status', 'pending')->count();
        $totalComments = Comment::count();
        $likesCount = Blog::sum('likes_count');

        return view('statistics.index', [
            'totalBlogs' => $totalBlogs,
            'approvedBlogs' => $approvedBlogs,
            'pendingBlogs' => $pendingBlogs,
            'totalComments' => $totalComments,
            'likesCount' => $likesCount,
        ]);
    }
}
