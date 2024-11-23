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

    // public function store(Request $request, $blogId)
    // {
    //     $blog = Blog::findOrFail($blogId);

    //         // Thêm bình luận
    //         Comment::create([
    //             'blog_id' => $blog->id,
    //             'user_id' => $request->user_id,
    //             'category_id' => $request->category_id,
    //             'content' => $request->content,
    //             'created_at' => now(), // Thêm giá trị thủ công
    //         ]);

    //       return redirect()->route('comment.index', ['blog' => $blog->id])->with('success', 'Bình luận đã được thêm!');  
    // }

    public function store(Request $request)
{
    // Kiểm tra người dùng đã đăng nhập hay chưa
    if (!Auth::check()) {
        return redirect()->route('auth.login')->with('error', 'Vui lòng đăng nhập trước khi bình luận.');
    }
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:1000',
        'blog_id' => 'required|exists:blogs,id', // Kiểm tra blog_id có tồn tại không
    ]);

    // Tìm blog tương ứng
    $blog = Blog::findOrFail($request->blog_id);

    // Lưu bình luận
    Comment::create([
        'blog_id' => $blog->id,
       'user_id' => Auth::user()->id, // Sử dụng Auth::user() để lấy thông tin người dùng
        'content' => $request->message,
        'created_at' => now(),
    ]);

    // Redirect đến trang danh sách bình luận của blog
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
    public function reply(Request $request, Comment $comment) {
        // Xử lý lưu câu trả lời bình luận vào cơ sở dữ liệu
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        $reply = new Comment();
        $reply->content = $request->content;
        $reply->user_id = auth()->id();
        $reply->parent_id = $comment->id; // Lưu id của bình luận cha
        $reply->save();
    
        return redirect()->back();
    }
    public function show($commentId)
    {
        // Lấy bình luận và các bình luận con của nó
        $comment = Comment::with('replies.user')->find($commentId);

        // Kiểm tra nếu bình luận không tồn tại
        if (!$comment) {
            return redirect()->back()->with('error', 'Bình luận không tồn tại!');
        }

        // Trả về view với dữ liệu
        return view('comments.show', compact('comment'));
    }

    
}
