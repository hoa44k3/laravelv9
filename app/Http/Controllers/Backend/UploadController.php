<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image; 

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ cho phép các định dạng ảnh
        ]);

        // Lưu ảnh vào thư mục 'public/images'
        $path = $request->file('image')->store('public/images');

        // Lưu đường dẫn ảnh vào CSDL
        $image = new Image();
        $image->path = $path;
        $image->save();

        return back()->with('success', 'Image uploaded successfully')->with('image', $path);
    }
}
