<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{
    public function showCategories()
    {
        $categories = Category::all(); 
        return view('category', compact('categories')); 
    }
}
