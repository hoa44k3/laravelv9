<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogAdminController extends Controller
{
    public function home()
    {
       // Lấy danh sách bài viết kèm số lượt thích và bình luận
            $blogs = Blog::with('user', 'category') // Lấy quan hệ với user và category
            ->withCount(['likes', 'comments'])  // Đếm số lượt thích và bình luận
            ->get()
            ->sortByDesc(function ($blog) {
                // Tính tổng điểm nổi bật (lượt thích + bình luận)
                return $blog->likes_count + $blog->comments_count;
            });

        // Lấy bài viết nổi bật nhất
        $featuredBlog = $blogs->first(); // Bài viết có điểm cao nhất
        $otherBlogs = $blogs->skip(1);   // Các bài viết khác

        return view('blogs.home', compact('featuredBlog', 'otherBlogs'));
                
    }
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        $likes = Like::all();
        return view('blogs.create', compact('categories','users','likes')); 
    }
    public function store(Request $request)
    {
        $create = new Blog();
        $create->title = $request->title;
        $create->content = $request->content;   
        $create->status = $request->status;
        $create->like_id = $request->like_id;
        $create->comment_count = $request->comment_count;   
        $create->user_id = $request->user_id;
        $create->category_id = $request->category_id;   

        if ($request->hasFile('image_path')) {
            $create->image_path = $request->file('image_path')->store('main', 'public');
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
              
                Storage::disk('public')->delete(' main/' . $blog->image_path);
             }

            $blog->delete();
            return response()->json(['status' => 'success']);
           
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
   
     // Xử lý ảnh nếu có ảnh mới
        if ($request->hasFile('image_path')) {
            // Xóa ảnh cũ nếu có
            if ($edit->image_path) {
                Storage::delete('public/' . $edit->image_path);
            }

            // Lưu ảnh mới vào thư mục 'public' và lấy đường dẫn lưu vào cơ sở dữ liệu
            $imagePath = $request->file('image_path')->store('main', 'public');
            $edit->image_path = $imagePath;
        }

        $edit->save();
        return redirect()->route('blogs.home')->with('success', 'Bài viết đã được cập nhật thành công!');
    }
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
