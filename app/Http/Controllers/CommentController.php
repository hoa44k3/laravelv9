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
        return view('comment.create', compact('blog'));
    }

    public function store(Request $request, $blogId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $blog = Blog::findOrFail($blogId);
        $blog->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
    ]);

        return redirect()->route('comment.index', ['blog' => $blogId])->with('success', 'Bình luận đã được thêm thành công!');
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
            'content' => 'required|string',
        ]);

        $comment = Comment::findOrFail($commentId);
        $comment->update(['content' => $request->content]);
        $blog = Blog::findOrFail($blogId);
        $comments = $blog->comments;
      return redirect()->route('comment.index', ['blog' => $blogId])
                     ->with('success', 'Bình luận đã được cập nhật thành công!')
                     ->with(compact('comments', 'blog'));
    }
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

         return response()->json(['success' => 'Bình luận đã được xóa thành công.']);
    }

}
