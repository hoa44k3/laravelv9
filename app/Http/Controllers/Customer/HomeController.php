<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('site.index');
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
   
    
}
