<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Vui lòng đăng nhập trước khi bình luận.');
        }
        // dd($request->all());
        $request->validate([
            'content' => 'required|string|max:1000',
            'blog_id' => 'required|exists:blogs,id', 
        ]);

        $newComment = Comment::create([
            'blog_id' => $request->blog_id,
            // 'user_id' => Auth::id(),
            'user_id' => auth()->id(),
            'content' => $request->content, 
            'created_at' => now(),
        ]);

        return redirect()->route('comment.index', ['blog' => $request->blog_id])
            ->with('success', 'Bình luận đã được thêm!');
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

    // Xóa bình luận
    $comment->delete();

    return response()->json(['success' => 'Bình luận đã được xóa thành công.']);
}
    public function showComments()
    {
        
        $categories = Category::with('blogs.comments.user')->get(); 

       
        return view('comment.index', compact('categories'));
    }
    public function reply(Request $request, Comment $comment) {
      
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        $reply = new Comment();
        $reply->content = $request->content;
        $reply->user_id = auth()->id();
        $reply->parent_id = $comment->id; 
        $reply->save();
    
        return redirect()->back();
    }
    public function show($commentId)
    {
        
        $comment = Comment::with('replies.user')->find($commentId);

       
        if (!$comment) {
            return redirect()->back()->with('error', 'Bình luận không tồn tại!');
        } 
        return view('comments.show', compact('comment'));
    }

    
}
