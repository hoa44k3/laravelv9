<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag; 
class CtvController extends Controller
{
    public function index()
    {
       
        $blogs = Blog::where('user_id', auth()->id())->paginate(10);
        return view('ctvien.index', compact('blogs'));
    }

    /**
     * Hiển thị form tạo bài viết mới.
     */
    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        // $tags = Tag::all();
        return view('ctvien.create', compact('categories'));
    }

    /**
     * Lưu bài viết mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image_path' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id', // Kiểm tra category_id hợp lệ
            // 'tag_id' => 'nullable|exists:tags,id',
        ]);

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $request->file('image_path')?->store('blogs', 'public'),
            'user_id' => auth()->id(),
            'status' => 'pending',
            'category_id' => $request->category_id, // Lưu danh mục
        //    'tag_id' => $request->tag_id?? null,
        ]);

        return redirect()->route('ctvien.index')->with('success', 'Bài viết đã được tạo.');
    }

    /**
     * Hiển thị form chỉnh sửa bài viết.
     */
    public function edit(Blog $blog)
    {
        if ($blog->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài viết này.');
        }

        $categories = Category::all(); // Lấy danh mục để chỉnh sửa
        // $tags = Tag::all(); 
        return view('ctvien.edit', compact('blog', 'categories'));
    }

    /**
     * Cập nhật bài viết vào cơ sở dữ liệu.
     */
    public function update(Request $request, Blog $blog)
    {
        if ($blog->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài viết này.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image_path' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
           
        ]);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $request->file('image_path')?->store('blogs', 'public') ?? $blog->image_path,
            'category_id' => $request->category_id, // Cập nhật danh mục
           
        ]);

        return redirect()->route('ctvien.index')->with('success', 'Bài viết đã được cập nhật.');
    }

    /**
     * Xóa bài viết khỏi cơ sở dữ liệu.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền xóa bài viết này.');
        }

        $blog->delete();

        return redirect()->route('ctvien.index')->with('success', 'Bài viết đã được xóa.');
    }

    // public function approve($id)
    // {
    //     $blog = Blog::findOrFail($id);
    //     $blog->status = 'approved';
    //     $blog->save();

    //     return redirect()->back()->with('success', 'Bài viết đã được duyệt.');
    // }
    public function approve($id)
    {
        // Tìm bài viết theo ID
        $blog = Blog::findOrFail($id);

        // Thay đổi trạng thái bài viết thành đã duyệt
        $blog->status = 'approved';
        $blog->save();

        // Chuyển hướng về trang danh sách blog sau khi duyệt
        return redirect()->route('blogs.home')->with('success', 'Bài viết đã được duyệt!');
    }
    public function reject($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 'rejected';
        $blog->save();

        return redirect()->back()->with('error', 'Bài viết đã bị từ chối.');
    }
   


}
