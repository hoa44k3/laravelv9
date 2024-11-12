<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function showBlogs()
    {
        $blogs = Blog::all(); 
        return view('blog', compact('blogs')); 
    }
}
