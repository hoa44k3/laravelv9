<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
class CommentController extends Controller
{
    public function index(Request $request, $blogId = null)
    {
        $blog = $blogId ? Blog::find($blogId) : null;
        $comments = $blog ? $blog->comments : Comment::with(['blog', 'user'])->get();
        return view('comment.index', compact('comments', 'blog'));
    }

    public function create($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $users = User::all();
        return view('comment.create', compact('blog','users'));
    }

    public function store(Request $request, $blogId)
    {
            // Xác thực dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'message' => 'required|string',
        ]);

        // Lấy thông tin bài viết với $blogId
        // $blog = Blog::findOrFail($blogId);

        // // Tạo một bình luận mới liên kết với bài viết
        // $blog->comments()->create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'website' => $request->website,
        //     'message' => $request->message,
        // ]);

        // Quay lại trang chi tiết bài viết hoặc trang quản lý bình luận
        // return redirect()->route('post', ['id' => $blogId])
        //     ->with('success', 'Bình luận đã được thêm thành công!');
$comment = new Comment();
    $comment->name = $request->name;
    $comment->email = $request->email;
    $comment->website = $request->website;
    $comment->message = $request->message;
    $comment->blog_id = $blogId;  // Lưu blog_id vào cơ sở dữ liệu
    $comment->save();

    return back()->with('success', 'Bình luận của bạn đã được gửi.');

    }


    public function edit($blogId, $commentId)
    {
        $blog = Blog::findOrFail($blogId);
        $comment = Comment::findOrFail($commentId);
        $users = User::all();
        return view('comment.edit', compact('comment', 'blog','users'));
    }

    public function update(Request $request, $blogId, $commentId)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);
    
        $blog = Blog::findOrFail($blogId);
        $comment = Comment::findOrFail($commentId);
    
        $comment->update([
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);
    
        return redirect()->route('comment.index', ['blog' => $blogId])
            ->with('success', 'Cập nhật bình luận thành công.');

    }
    public function destroy($commentId)
    {
        $comment = Comment::find($commentId);

        if (!$comment) {
            return response()->json(['error' => 'Bình luận không tồn tại.'], 404);
        }
    
        $comment->delete();
    
        return response()->json(['success' => 'Bình luận đã được xóa thành công.']);
    }

}
