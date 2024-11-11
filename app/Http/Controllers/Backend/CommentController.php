<?php

namespace App\Http\Controllers\Backend;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($blog_id = null)
    {  
    //     $comments = Comment::with(['user', 'blog.category'])->get();
    //    $blog = Blog::with('category')->findOrFail($blog_id);
    //    if (!$blog) {
    //          return redirect()->route('backend.blog.index')->withErrors('Bài viết không tồn tại.');
    //     }
    //     $comments = Comment::where('blog_id', $blog_id)->with('user')->get();
    //     return view('backend.comment.index', compact('comments', 'blog'));

    $blog = $blog_id ? Blog::with('category')->find($blog_id) : null;

    if ($blog_id && !$blog) {
        return redirect()->route('backend.blog.index')->withErrors('Bài viết không tồn tại.');
    }

    $comments = $blog ? $blog->comments()->with('user')->get() : Comment::with(['user', 'blog.category'])->get();

    return view('backend.comments.index', compact('blog', 'comments'));

    }
    public function indexAll()
    {
         $comments = Comment::with(['blog', 'blog.category','user'])->get();
        return view('backend.comment.index', compact('comments'));
    }

    public function createComment($blog_id)
{
   $blog = Blog::with('category')->findOrFail($blog_id);
   $users = User::all(); 
   $categories = Category::all();
    return view('backend.comment.create', compact('blog','users','categories'));
}
    public function store(Request $request, $blog_id)
    {
          $validated = $request->validate([
              'content' => 'required|string',
             'user_id' => 'required|exists:users,id',
             ]);

    // Tạo bình luận mới với blog_id, user_id và nội dung đã xác thực
    Comment::create([
        'blog_id' => $blog_id,
        'user_id' => $validated['user_id'],
        'content' => $validated['content'],
        'created_at' => now(), // Thêm thời gian hiện tại
    ]);

    return redirect()->route('backend.comment.index', ['blog' => $blog_id])
        ->with('success', 'Bình luận đã được thêm thành công!');
}


    public function edit($blogId, $commentId)
    {   
        $blog = Blog::find($blogId);
        $comment = Comment::find($commentId);
        
        if (!$blog || !$comment) {
            abort(404); // Nếu blog hoặc bình luận không tồn tại, trả về lỗi 404
        }
        
        return view('backend.comment.edit', compact('blog', 'comment'));
    }
    
public function update(Request $request, $blog_id, $id)
{
    $data = $request->validate([
        'author' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $comment = Comment::findOrFail($id);
    $comment->update($data);
   return redirect()->route('backend.comment.index', ['blog' => $comment->blog_id])->with('success', 'Comment updated successfully.');
}
public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $blog_id = $comment->blog_id;
        $comment->delete();

        return redirect()->route('backend.comment.index', ['blog' => $blog_id])->with('success', 'Comment deleted successfully.');
    }


}
