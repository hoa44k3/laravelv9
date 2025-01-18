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

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
        $image_path = null;
        if ($request->hasFile('image_path')) {
            $image_path = $request->file('image_path')->store('category', 'public');    
        }

       
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

    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

   
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
    
       
        if ($category->image_path) {
            Storage::disk('public')->delete('category/' . $category->image_path);
        }
        
      
        $category->delete();
        
        return response()->json(['status' => 'success']);
    }
    
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
        $category = Category::findOrFail($id);

       
        if ($request->hasFile('image_path')) {
          
            if ($category->image_path) {
                Storage::disk('public')->delete('category/' . $category->image_path);
            }

           
            $category->image_path = $request->file('image_path')->store('category', 'public');
    }

   
    $category->name = $request->name;
    $category->comment = $request->comment;

  
    $category->save();

    return redirect()->route('category.home')->with('success', 'Danh mục đã được cập nhật thành công!');
}

}
