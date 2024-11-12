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

        $image_path = null;
        // if ($request->hasFile('image_path')) {
        //     $image_path = $request->file('image_path')->store('blogs', 'public');
        //     $create->image_path = $image_path; 
        // }
        if ($request->hasFile('image_path')) {
            $image_path = $request->file('image_path')->store('blogs', 'public');
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
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

            if ($blog->image_path) {
                //Storage::disk('public')->delete($blog->image_path);
                Storage::disk('public')->delete('blog/' . $blog->image_path);
             }

            $blog->delete();
            return response()->json(['status' => 'success']);
            //return response()->json(['success' => 'Bài viết đã được xóa thành công.']);
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
    // public function show($id)
    // {
    //     $blog = Blog::with('user')->findOrFail($id); // Lấy bài viết và thông tin tác giả
    //         $comments = Comment::with('user')->where('blog_id', $id)->get(); // Lấy bình luận và thông tin tác giả bình luận

    //         $totalLikes = $blog->likes_count; // Tổng lượt thích
    //         $totalComments = $comments->count(); // Tổng bình luận
    //             return view('backend.blog.show', compact('blog', 'totalLikes', 'totalComments','comments'));
    // }
    public function show($id)
    {
        // Lấy thông tin bài viết
        $blog = Blog::findOrFail($id);
    
        // Lấy tổng số lượt thích
        $totalLikes = $blog->likes()->count();
    
        // Lấy tổng số bình luận
        $totalComments = $blog->comments()->count();
    
        // Lấy các bình luận
        $comments = $blog->comments;
        $blog = Blog::with('comments.user')->find($id);

        return view('blogs.show', compact('blog', 'totalLikes', 'totalComments', 'comments'));
    }
    
    public function statistics()
    {
        $totalBlogs = Blog::count();
        $approvedBlogs = Blog::where('status', 'approved')->count();
        $pendingBlogs = Blog::where('status', 'pending')->count();
        $totalComments = Comment::count();
        $totalUsers = User::count();
        $likesCount = Blog::withCount('likes')->get();
        return view('statistics.index', [
            'totalBlogs' => $totalBlogs,
            'approvedBlogs' => $approvedBlogs,
            'pendingBlogs' => $pendingBlogs,
            'totalComments' => $totalComments,
            'likesCount' => $likesCount,
            'totalUsers' => $totalUsers,
        ]);
    }

    public function toggleApproval($id)
{
    $blog = Blog::find($id);
    
    if (!$blog) {
        return response()->json(['error' => 'Không tìm thấy bài viết'], 404);
    }

    // Đổi trạng thái phê duyệt
    $blog->status = $blog->status === 'approved' ? 'pending' : 'approved';
    $blog->save();

    return response()->json([
        'success' => true,
        'message' => 'Trạng thái đã được cập nhật thành công',
        'status' => $blog->status
    ]);
}

}
