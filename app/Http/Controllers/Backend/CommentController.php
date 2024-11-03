<?php

namespace App\Http\Controllers\Backend;
use App\Models\Blog;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($blog_id)
    {
        // $comments = Comment::with(['user', 'blog.category'])->where('blog_id', $blog_id)->get();
        $comments = Comment::with(['user', 'blog.category'])->get();

       $blog = Blog::with('category')->findOrFail($blog_id);
       if (!$blog) {
        // Xử lý khi không tìm thấy blog, có thể redirect hoặc thông báo lỗi
        return redirect()->route('backend.blog.index')->withErrors('Bài viết không tồn tại.');
    }
      // $comments = Comment::where('blog_id', $blog_id)->with(['blog', 'blog.category'])->get();
      $comments = Comment::where('blog_id', $blog_id)->with('user')->get();
        // Trả về view với dữ liệu
        return view('backend.comment.index', compact('comments', 'blog'));
    }
    public function indexAll()
    {
         $comments = Comment::with(['blog', 'blog.category'])->get();
        return view('backend.comment.index', compact('comments'));
    }

    public function createComment($blog_id)
{
   $blog = Blog::with('category')->findOrFail($blog_id);
    return view('backend.comment.create', compact('blog'));
}
    public function store(Request $request, $blog_id)
    {
        //  $data = $request->validate([
        //       'author' => 'required|string|max:255',
        //      'content' => 'required|string',
        //      'blog_id' => 'required|exists:blogs,id',
        // ]);
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        // $blog = Blog::findOrFail($blog_id);
        // $blog->comments()->create($data);

        $comment = Comment::create([
            'author' => $validated['author'],
            'content' => $validated['content'],
            'blog_id' => $validated['blog_id'],
            'created_at' => now(), // Thêm thời gian hiện tại
        ]);
        return redirect()->route('backend.comment.index', ['blog' => $validated['blog_id']])
        ->with('success', 'Bình luận đã được thêm thành công!');
        //  return redirect()->route('backend.comment.index', ['blog' => $blog_id])->with('success', 'Comment added successfully.');
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
