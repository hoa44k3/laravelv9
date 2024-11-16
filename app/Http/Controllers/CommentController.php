<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
class CommentController extends Controller
{
    public function index( $blogId = null)
    {
        $comments = Comment::with(['blog.category', 'user']) 
        ->when($blogId, function ($query) use ($blogId) {
            $query->where('blog_id', $blogId);
        })
        ->get();

        $blog = $blogId ? Blog::find($blogId) : null;  
        return view('comment.index', compact('comments', 'blog'));
    }

    public function create($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $users = User::all();
        $categories = Category::all();
        return view('comment.create', compact('blog','users', 'categories'));
    }

    public function store(Request $request, $blogId)
    {
        $blog = Blog::findOrFail($blogId);

            // Thêm bình luận
            Comment::create([
                'blog_id' => $blog->id,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'created_at' => now(), // Thêm giá trị thủ công
            ]);

          return redirect()->route('comment.index', ['blog' => $blog->id])->with('success', 'Bình luận đã được thêm!');  
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
    public function showComments()
    {
        // Lấy danh sách các categories từ cơ sở dữ liệu cùng với blogs và comments của từng category
        $categories = Category::with('blogs.comments.user')->get(); // Eager load blogs, comments và user

        // Trả về view và truyền biến categories vào
        return view('comment.index', compact('categories'));
    }
}
