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
    public function toggleLike($id)
{
    $blog = Blog::findOrFail($id);
    $user = auth()->user();

    if (!$user) {
        return response()->json(['error' => 'Bạn cần đăng nhập để thực hiện hành động này'], 401);
    }

    // Kiểm tra nếu người dùng đã thích bài viết
    if ($blog->likes()->where('user_id', $user->id)->exists()) {
        // Nếu đã thích, xóa like
        $blog->likes()->where('user_id', $user->id)->delete();
        $like = false;
    } else {
        // Nếu chưa thích, thêm like
        $blog->likes()->create(['user_id' => $user->id]);
        $like = true;
    }

    // Trả về số lượt thích hiện tại
    return response()->json([
        'likes_count' => $blog->likes()->count(),
        'like' => $like,
    ]);
}

}
