<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image; 

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file (chấp nhận cả hình ảnh và video)
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // Cho phép các định dạng hình ảnh và video với dung lượng tối đa 10MB
        ]);
    
        // Lưu file vào thư mục 'public/uploads'
        $path = $request->file('file')->store('public/uploads');
    
        // Kiểm tra loại file và lưu vào CSDL
        $fileType = $request->file('file')->getMimeType();
        $file = new Image(); // Bạn có thể đổi tên Model `Image` thành `Media` nếu muốn tổng quát hóa
        $file->path = $path;
        $file->type = $fileType; // Lưu loại tệp (image/video)
        $file->save();
    
        return back()->with('success', 'File uploaded successfully')->with('file', $file);
    }
    
}
