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
    public function index($blogId){
        $categories = Category::all();
       // $blogs = Blog::all();
        $blog = Blog::withCount('comments')->findOrFail($blogId);
        return view('site.index', compact('categories','blogs'));
    }
    public function contact(){
        $blog = Blog::first();
        return view('site.contact',compact('blog'));
    }
    public function blog(){
       // $blogs = Blog::with('user', 'category')->paginate(10); 
       $blogs = Blog::withCount('likes')  // Lấy số lượt thích của mỗi blog
       ->with('user', 'category') // Lấy các quan hệ với user và category
       ->paginate(10);
        return view('site.blog',compact('blogs'));
    }
    public function post($id){
        $blog = Blog::findOrFail($id);

        $comments = $blog->comments;
        return view('site.post', compact('blog', 'comments'));
    }
    public function category(){
        $categories = Category::all();
       // $categories = Category::where('status', 'active')->get();
        $blog = Blog::first();
        return view('site.category', compact('categories','blog'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
            'website' => 'nullable|url', 
        ]);
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->website = $request->website;
        $comment->message = $request->message;
        $comment->blog_id = $request->blog_id;
        $comment->save();

        return back()->with('success', 'Bình luận của bạn đã được gửi.');
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
