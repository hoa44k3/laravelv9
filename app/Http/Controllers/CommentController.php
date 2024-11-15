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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

         $blog = Blog::findOrFail($blogId);

    $blog->comments()->create([
        'user_id' => $request->user_id,
        'content' => $request->content,
    ]);

    return redirect()->route('comment.index', ['blog' => $blogId])
        ->with('success', 'Bình luận đã được thêm thành công!');
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
