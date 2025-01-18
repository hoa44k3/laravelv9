<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{

        public function index()
        {
            
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);

     
        return view('site.category', compact('categories'));
        }
   }
