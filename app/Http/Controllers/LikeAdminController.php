<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Blog;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeAdminController extends Controller
{
    public function index()
    {
       
        $likes = Like::with(['blog', 'user'])->get(); 
        return view('likes.home', compact('likes'));
        
    }


    public function create()
    {
        $blogs = Blog::all();
        $users = User::all();
        return view('likes.create', compact('blogs', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Like::create($request->all());

        return redirect()->route('likes.index')->with('success', 'Lượt thích đã được thêm thành công!');
    }
    public function edit($id)
    {
        $like = Like::findOrFail($id);
        $blogs = Blog::all();
        $users = User::all();
        return view('likes.edit', compact('like', 'blogs', 'users'));
    }
    public function update(Request $request, Like $like)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $like->update($request->all());

        return redirect()->route('likes.index')->with('success', 'Lượt thích đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();
        return response()->json(['success' => 'Lượt thích đã được xóa thành công.']);
    }
    public function toggleLike(Request $request, $blogId)
{
    $user = auth()->user();
    $blog = Blog::findOrFail($blogId);
    $existingLike = $blog->likes()->where('user_id', $user->id)->first();

    if ($existingLike) {
        $existingLike->delete();
        $isLiked = false;
    } else {
       
        $blog->likes()->create(['user_id' => $user->id]);
        $isLiked = true;
    }
    $likesCount = $blog->likes()->count();

    return response()->json([
        'like' => $isLiked,
        'likes_count' => $likesCount,
    ]);
}
}
