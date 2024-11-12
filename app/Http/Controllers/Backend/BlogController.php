<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function index()
    { 
        $blogs = Blog::with(['user', 'category'])->withCount('likes')->get();
        return view('backend.blog.index', compact('blogs'));

    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all(); 
        return view('backend.blog.create', compact('categories','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:approved,pending',
            'likes' => 'required|integer|min:0',
            'comment_count' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
        }
    Blog::create([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'user_id' => $request->user_id,
        'likes' => $request->likes,
        'comment_count' => $request->comment_count,
        'status' => $request->status,
        'image_path' => $imagePath, // Nếu không có ảnh, gán là null
    ]);
   
        return redirect()->route('backend.blog.index')->with('success', 'Bài viết đã được tạo thành công!');
    }

public function edit(Blog $blog)
{
    // Lấy danh sách các danh mục
    $categories = Category::all(); 

    return view('backend.blog.edit', compact('blog', 'categories'));
}


public function update(Request $request, Blog $blog)
{
    // Xác thực dữ liệu nhập vào
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:approved,pending',
        'likes' => 'required|integer|min:0',
        'comment_count' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'user_id' => 'required|exists:users,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    // Cập nhật các trường của bài viết
    $blog->title = $request->title;
    $blog->content = $request->content;
    $blog->status = $request->status;
    $blog->likes = $request->likes; // Cập nhật lượt thích
    $blog->comment_count = $request->comment_count; // Cập nhật lượt bình luận
    $blog->category_id = $request->category_id; // Cập nhật danh mục
    $blog->user_id = $request->user_id;

    // Xử lý cập nhật file ảnh
    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu có (tùy thuộc vào yêu cầu của bạn)
        if ($blog->image_path) {
            Storage::delete($blog->image_path); // Xóa ảnh cũ khỏi hệ thống
        }
        
        // Lưu ảnh mới
        $path = $request->file('image')->store('images', 'public'); // Lưu vào thư mục images trong ổ đĩa public
        $blog->image_path = $path; // Cập nhật đường dẫn vào cơ sở dữ liệu
    }

    // Lưu các thay đổi vào cơ sở dữ liệu
    $blog->save();

    return redirect()->route('backend.blog.index')->with('success', 'Bài viết đã được cập nhật thành công!');
}


    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('backend.blog.index')->with('success', 'Bài viết đã được xóa thành công!');
    }

    public function approve(Blog $blog)
    {
        // Chỉ admin mới có quyền duyệt bài viết
        // Kiểm tra nếu người dùng hiện tại là admin
        if (auth()->user()->is_admin) {
            $blog->status = 'approved';
            $blog->save();

            return redirect()->route('backend.blog.index')->with('success', 'Bài viết đã được phê duyệt!');
        }

        return redirect()->route('backend.blog.index')->with('error', 'Bạn không có quyền duyệt bài viết.');
    }
    public function show($id)
    {
$blog = Blog::with('user')->findOrFail($id); // Lấy bài viết và thông tin tác giả
    $comments = Comment::with('user')->where('blog_id', $id)->get(); // Lấy bình luận và thông tin tác giả bình luận

    $totalLikes = $blog->likes_count; // Tổng lượt thích
    $totalComments = $comments->count(); // Tổng bình luận
         return view('backend.blog.show', compact('blog', 'totalLikes', 'totalComments','comments'));
    }
public function statistics()
{
    // Đếm số bài viết
    $totalBlogs = Blog::count();
    $approvedBlogs = Blog::where('status', 'approved')->count();
    $pendingBlogs = Blog::where('status', 'pending')->count();

    // Đếm tổng số bình luận
    $totalComments = Comment::count();

    // Tính tổng lượt thích của tất cả bài viết
   // $likesCount = Blog::sum('likes_count');
    $likesCount = Blog::withCount('likes')->get();

    return view('backend.statistics.index', [
        'totalBlogs' => $totalBlogs,
        'approvedBlogs' => $approvedBlogs,
        'pendingBlogs' => $pendingBlogs,
        'totalComments' => $totalComments,
        'likesCount' => $likesCount,
    ]);
}



}