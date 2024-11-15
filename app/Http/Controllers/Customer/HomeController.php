<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Comment;
class HomeController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('site.index', compact('categories'));
    }
    public function contact(){
        return view('site.contact');
    }
    public function blog(){
        $blogs = Blog::with('user', 'category')->get();
        return view('site.blog',compact('blogs'));
    }
    public function post($id){
        $blogs = Blog::with('user', 'category')->get();
        $blog = Blog::with('comments')->findOrFail($id);
      //  $comments = $blog ? $blog->comments : Comment::with(['blog', 'user'])->get();
        return view('site.post',compact('blogs','comments'));
    }
    public function category(){

        $categories = Category::all();
        return view('site.category', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu bình luận
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        // Lưu bình luận
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->website = $request->website;
        $comment->message = $request->message;
        $comment->blog_id = $request->blog_id;
        $comment->save();

        return back()->with('success', 'Bình luận của bạn đã được gửi.');
    }
}
