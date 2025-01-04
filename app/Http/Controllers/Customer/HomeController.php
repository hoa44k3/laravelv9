<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use App\Models\Guide;
use App\Models\Event;
use App\Models\job;
class HomeController extends Controller
{
    public function index(){
        $categories = Category::all();
        $featuredBlog = Blog::withCount(['likes', 'comments','tags'])
            ->with('user', 'comments.user')
            ->latest() 
            ->first();

        $blogs = Blog::withCount(['likes', 'comments'])
            ->with('user')
            ->where('id', '!=', optional($featuredBlog)->id) 
            ->latest() 
            ->paginate(3);
        return view('site.index', compact('categories', 'blogs', 'featuredBlog'));
    }
    public function toggleLike(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Bạn phải đăng nhập để thực hiện hành động này.']);
        }

        $blog = Blog::findOrFail($id);

        if ($blog->likes()->where('user_id', auth()->id())->exists()) {
            $blog->likes()->where('user_id', auth()->id())->delete();
            $like = false;
        } else {
            $blog->likes()->create(['user_id' => auth()->id()]);
            $like = true;
        }

        return response()->json([
            'success' => true,
            'like' => $like,
            'likes_count' => $blog->likes()->count(),
        ]);
    }

    public function contact(){
        $blog = Blog::first();
        return view('site.contact',compact('blog'));
    }
    public function blog(){
       $blogs = Blog::withCount('comments','likes')  
       ->with('user', 'category') 
       ->paginate(10);
        return view('site.blog',compact('blogs'));
    }
    public function post($id = null)
    {
        if ($id) {
            $featuredBlog = Blog::withCount(['likes', 'comments'])
                ->with('user', 'comments.user')
                ->findOrFail($id); 
            $category = $featuredBlog->category;
        } else {

            $featuredBlog = Blog::withCount(['likes', 'comments'])
                ->with('user', 'comments.user')
                ->latest() 
                ->first();
        }
        $otherBlogs = Blog::withCount(['likes', 'comments'])
            ->with('user')
            ->where('id', '!=', $featuredBlog->id) 
            ->latest() 
            ->paginate(3); 
        return view('site.post', compact('category','featuredBlog', 'otherBlogs'));
    }

    public function category(){
        $categories = Category::all();
        $blog = Blog::first();
        return view('site.category', compact('categories','blog'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'blog_id' => 'required|exists:blogs,id',
            'parent_id' => 'nullable|exists:comments,id'
        ]);
    
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->content = $request->message;
        $comment->blog_id = $request->blog_id;
        $comment->parent_id = $request->parent_id; 
    
        $comment->save();
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
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('site.index')->with('success', 'Bạn đã đăng xuất thành công');
    }
    public function search(Request $request)
    {
        $query = $request->input('query'); 

        // Tìm kiếm bài viết theo tên
        $blogs = Blog::where('title', 'LIKE', '%' . $query . '%')
        ->orWhere('content', 'LIKE', '%' . $query . '%')
        ->orWhereHas('user', function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%');
        })
        ->paginate(10);
    

        return view('site.search', compact('blogs', 'query'));
    }
    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);
    
        $comment->replies()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->back()->with('success', 'Trả lời đã được thêm.');
    }
    public function guides()
    {
        $guides = Guide::latest()->get(); 
        return view('site.guides', compact('guides')); 
    }
    public function guidesdetail($id)
    {
        // Lấy chi tiết hướng dẫn theo ID
        $guide = Guide::findOrFail($id);

        // Trả về view với dữ liệu hướng dẫn
        return view('site.guidesdetail', compact('guide'));
    }
    public function event()
    {
        // Lấy tất cả sự kiện
        $events = Event::all();

        // Trả về view với dữ liệu sự kiện
        return view('site.event', compact('events'));
    }
    public function eventdetail($id)
    {
      // Lấy chi tiết sự kiện theo ID
    $event = Event::findOrFail($id);

    // Trả về view với dữ liệu sự kiện
    return view('site.eventdetail', compact('event'));
    }
    public function job()
    {
        // Lấy tất cả công việc
        $jobs = Job::all();

        // Trả về view với dữ liệu công việc
        return view('site.job', compact('jobs'));
    }
    public function jobdetail($id)
    {
      // Lấy chi tiết công việc theo ID
        $job = Job::findOrFail($id);

        // Trả về view với dữ liệu công việc
        return view('site.jobdetail', compact('job'));
    }
}
