<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends Controller
{

        public function index()
        {
            // $categories = Category::all();
            // dd($categories); // Kiểm tra dữ liệu trước khi truyền vào view
            // return view('site.index', compact('categories'));

            // Lấy tất cả danh mục hoặc lọc theo điều kiện nếu cần
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);

        // Trả về view 'user.categories.index' và truyền biến $categories
        return view('site.category', compact('categories'));
        }
   }
