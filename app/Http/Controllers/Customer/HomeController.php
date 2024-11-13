<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
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
        return view('site.blog');
    }
    public function post(){
        return view('site.post');
    }
    public function category(){

        $categories = Category::all();
        return view('site.category', compact('categories'));
    }
    
}
