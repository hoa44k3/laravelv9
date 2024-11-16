<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class CategoryAdminController extends Controller
{
    public function home(Request $request)
    {     
       // $categories = Category::all(); 
       $categories = Category::with(['blogs.comments'])->get();
         return view('category.home', compact('categories')); 
    }

    public function create()
    {
        return view('category.create');  
    }

    // Phương thức tạo và cập nhật danh mục
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Kiểm tra nếu có file hình ảnh
        $image_path = null;
        if ($request->hasFile('image_path')) {
            $image_path = $request->file('image_path')->store('category', 'public');    
        }

        // Tạo mới hoặc cập nhật danh mục
        $category = Category::updateOrCreate(
            ['id' => $request->category_id],
            [
                'name' => $request->name,
                'comment' => $request->comment,
                'image_path' => $image_path,
            ]
        );

        return redirect()->route('category.home')->with('success', 'Danh mục đã được lưu thành công!');
    }

    // Phương thức sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    // Phương thức xóa danh mục
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
    
        // Xóa ảnh nếu có
        if ($category->image_path) {
            Storage::disk('public')->delete('category/' . $category->image_path);
        }
        
        // Xóa danh mục
        $category->delete();
        
        return response()->json(['status' => 'success']);
    }
    // Phương thức cập nhật danh mục
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu nhập vào
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Tìm danh mục cần cập nhật
        $category = Category::findOrFail($id);

        // Kiểm tra nếu có file hình ảnh
        if ($request->hasFile('image_path')) {
            // Xóa ảnh cũ nếu có
            if ($category->image_path) {
                Storage::disk('public')->delete('category/' . $category->image_path);
            }

            // Lưu ảnh mới
            $category->image_path = $request->file('image_path')->store('category', 'public');
    }

    // Cập nhật thông tin danh mục
    $category->name = $request->name;
    $category->comment = $request->comment;

    // Lưu danh mục
    $category->save();

    return redirect()->route('category.home')->with('success', 'Danh mục đã được cập nhật thành công!');
}

}
