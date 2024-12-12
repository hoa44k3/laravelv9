<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogAdminController extends Controller
{
    public function home()
    {
            $blogs = Blog::with('user', 'category','tags') 
            ->withCount(['likes', 'comments'])  
            ->get()
            ->sortByDesc(function ($blog) {
                return $blog->likes_count + $blog->comments_count;
            });
        $featuredBlog = $blogs->first(); 
        $otherBlogs = $blogs->skip(1);   
        return view('blogs.home', compact('featuredBlog', 'otherBlogs'));
                
    }
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        $likes = Like::all();
        return view('blogs.create', compact('categories','users','likes')); 
    }
    
    public function store(Request $request)
    {
         //dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        try {
            $blog = new Blog();
            $blog->title = $request->input('title');
            $blog->content = $request->input('content');
            $blog->user_id = $request->input('user_id');
            $blog->category_id = $request->input('category_id');
            $blog->status = 'pending'; 
            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('main', 'public'); 
                $blog->image_path = $path;
            }
            $blog->save();
            if ($request->has('tag_ids')) {
                $blog->tags()->sync($request->tag_ids); // Đồng bộ tag
            }
            return redirect()->route('blogs.home')->with('success', 'Bài viết đã được tạo thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo bài viết: ' . $e->getMessage());

            return redirect()->back()->withErrors('Không thể thêm bài viết. Vui lòng thử lại sau.');
        }
    }
    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();
        return view('blogs.edit', compact('blog', 'categories','users','tags'));
    }
    

    public function update(Request $request, $id)
    {
        $edit = Blog::find($id);
        $edit->title = $request->title;
        $edit->content = $request->content;  
        $edit->status = $request->status;
        $edit->likes = $request->likes;  
        $edit->comment_count = $request->comment_count;  
        $edit->user_id = $request->user_id;
        $edit->category_id = $request->category_id;  

        if ($request->hasFile('image_path')) {

            // if ($edit->image_path) {
            //     Storage::delete('public/' . $edit->image_path);
            // }
            if ($edit->image_path && Storage::exists("storage/" . $edit->image_path)) {
                Storage::delete("storage/" . $edit->image_path);
            }
            
            $imagePath = $request->file('image_path')->store('storage/main', 'public');
            $edit->image_path = $imagePath;
        }
        if ($request->has('tag_ids')) {
                $edit->tags()->sync($request->tag_ids); // Đồng bộ các thẻ tag
         }

        $edit->save();
        return redirect()->route('blogs.home')->with('success', 'Bài viết đã được cập nhật thành công!');
    }
    
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $totalLikes = $blog->likes()->count();
        $totalComments = $blog->comments()->count();
        $comments = $blog->comments;
        $blog = Blog::with('comments.user')->find($id);
        return view('blogs.show', compact('blog', 'totalLikes', 'totalComments', 'comments'));
    }
    
    public function statistics()
    {
        $totalBlogs = Blog::count();
        $approvedBlogs = Blog::where('status', 'approved')->count();
        $pendingBlogs = Blog::where('status', 'pending')->count();
        $totalComments = Comment::count();
        $totalUsers = User::count();
        $likesCount = Blog::withCount('likes')->get();
        return view('statistics.index', [
            'totalBlogs' => $totalBlogs,
            'approvedBlogs' => $approvedBlogs,
            'pendingBlogs' => $pendingBlogs,
            'totalComments' => $totalComments,
            'likesCount' => $likesCount,
            'totalUsers' => $totalUsers,
        ]);
    }

    public function toggleApproval($id)
    {
        $blog = Blog::find($id);
        
        if (!$blog) {
            return response()->json(['error' => 'Không tìm thấy bài viết'], 404);
        }

        // Đổi trạng thái phê duyệt
        $blog->status = $blog->status === 'approved' ? 'pending' : 'approved';
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái đã được cập nhật thành công',
            'status' => $blog->status
        ]);
    }
    public function search(Request $request)
    {
        $query = $request->input('query'); 
        $blogs = Blog::where('title', 'LIKE', "%{$query}%")->get();

        return view('blogs.search', compact('blogs', 'query')); 
    }


}
