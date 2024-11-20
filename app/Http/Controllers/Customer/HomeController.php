<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Contact;
class HomeController extends Controller
{
    public function index(){
        $categories = Category::all();

    // Lấy bài viết nổi bật
        $featuredBlog = Blog::withCount(['likes', 'comments'])
            ->with('user', 'comments.user') // Eager load user và comments.user
            ->latest() // Lấy bài viết mới nhất
            ->first(); // Lấy bài viết đầu tiên

        // Lấy các bài viết khác
        $blogs = Blog::withCount(['likes', 'comments'])
            ->with('user') // Eager load user
            ->where('id', '!=', optional($featuredBlog)->id) // Loại bỏ bài viết nổi bật (nếu có)
            ->latest() // Lấy các bài viết mới nhất
            ->paginate(3); // Phân trang 3 bài viết mỗi lần

        return view('site.index', compact('categories', 'blogs', 'featuredBlog'));
    }
    public function contact(){
        $blog = Blog::first();
        return view('site.contact',compact('blog'));
    }
    public function blog(){
       $blogs = Blog::withCount('comments','likes')  
       ->with('user', 'category') // Lấy các quan hệ với user và category
       ->paginate(10);
        return view('site.blog',compact('blogs'));
    }
    public function post($id = null){

        // Nếu có ID, lấy bài viết theo ID đó, nếu không lấy bài viết nổi bật
        $featuredBlog = $id ? Blog::withCount(['likes', 'comments'])->with('user', 'comments.user')->findOrFail($id) :
        Blog::withCount(['likes', 'comments'])->with('user', 'comments.user')->latest()->first();

    // Lấy các bài viết còn lại (trừ bài viết hiện tại)
        $otherBlogs = Blog::withCount(['likes', 'comments'])->with('user')->where('id', '!=', $featuredBlog->id)->latest()->paginate(3);

        // Trả về view với cả hai biến
        return view('site.post', compact('featuredBlog', 'otherBlogs'));

    }
    public function category(){
        $categories = Category::all();
        $blog = Blog::first();
        return view('site.category', compact('categories','blog'));
    }
    // public function store(Request $request, $blogId)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'message' => 'required|string',
    //         'blog_id' => 'required|exists:blogs,id',
    //         'website' => 'nullable|url', 
    //     ]);
    //     $comment = new Comment();
    //     $comment->name = $request->name;
    //     $comment->email = $request->email;
    //     $comment->website = $request->website;
    //     $comment->message = $request->message;
    //     $comment->blog_id = $request->blog_id;
    //     $comment->parent_id = $request->parent_id; 
    //     $comment->save();

    
    //     $blog = Blog::find($request->blog_id);
    //     $blog->increment('comments_count');
    //     return back()->with('success', 'Bình luận của bạn đã được gửi.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'blog_id' => 'required|exists:blogs,id',
            'parent_id' => 'nullable|exists:comments,id'  // Kiểm tra nếu có bình luận trả lời
        ]);
    
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->content = $request->message;
        $comment->blog_id = $request->blog_id;
        $comment->parent_id = $request->parent_id; // Gán parent_id nếu có
    
        $comment->save();
    
        // Cập nhật số lượng bình luận của bài viết
        $blog = Blog::find($request->blog_id);
        $blog->increment('comments_count');
    
        return back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
    }
    

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'email', 'message'));
    
        return back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
    }
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('site.post', compact('blog'));
    }

}
