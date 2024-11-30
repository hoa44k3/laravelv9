<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Log;
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
        dd($request->all());
        // Validate dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        try {
            // Khởi tạo bài viết mới
            $blog = new Blog();
            $blog->title = $request->input('title');
            $blog->content = $request->input('content');
            $blog->user_id = $request->input('user_id');
            $blog->category_id = $request->input('category_id');
            $blog->status = 'pending'; // Mặc định trạng thái là "pending"
    
            // Xử lý hình ảnh nếu có
            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('main', 'public'); // Lưu vào storage/app/public/main
                $blog->image_path = $path;
            }
    
            // Lưu bài viết
            $blog->save();
    
            // Điều hướng về trang danh sách bài viết với thông báo thành công
            return redirect()->route('blogs.home')->with('success', 'Bài viết đã được tạo thành công!');
        } catch (\Exception $e) {
            // Ghi log lỗi nếu có
            Log::error('Lỗi khi tạo bài viết: ' . $e->getMessage());
    
            // Điều hướng lại với thông báo lỗi
            return redirect()->back()->withErrors('Không thể thêm bài viết. Vui lòng thử lại sau.');
        }
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
        $blog = Blog::findOrFail($id);
        $totalLikes = $blog->likes()->count();
        $totalComments = $blog->comments()->count();
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
