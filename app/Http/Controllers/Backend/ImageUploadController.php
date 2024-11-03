<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    // Hiển thị trang upload
    public function index()
    {
        return view('Image.upload'); // Đảm bảo view nằm trong thư mục resources/views/Image/upload.blade.php
    }

    // Xử lý upload ảnh
    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240', // Giới hạn 10MB và chỉ cho phép các loại tệp ảnh
        ]);

        $paths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Lưu file vào thư mục "public/uploads"
                $path = $file->store('uploads', 'public');
                $paths[] = '/storage/' . $path; // Lưu đường dẫn để hiển thị
            }
        }

        return back()->with(['success' => 'Upload thành công!', 'paths' => $paths]);
    }

   // Hiển thị QR Code
public function showQrCode()
{
    // Đường dẫn ảnh ví dụ, hãy chắc chắn rằng đường dẫn này là hợp lệ trong hệ thống của bạn
    $imagePath = asset('storage/uploads/your_image.jpg'); // Đường dẫn thực tế của ảnh
    $shortLink = "https://chanh.in/iDheA"; // Đường dẫn rút gọn của ảnh hoặc liên kết đến ảnh tải xuống

    return view('Image.uploadqr', [
        'imagePath' => $imagePath,
        'shortLink' => $shortLink,
    ]);
}

// Tải xuống ảnh
public function download($filename)
{
    // Kiểm tra đường dẫn ảnh trong thư mục "storage/app/public/uploads"
    $path = storage_path('app/public/uploads/' . $filename);

    if (!file_exists($path)) {
        // Nếu ảnh không tồn tại, trả về mã lỗi 404
        return abort(404);
    }

    // Trả về response tải xuống ảnh
    return response()->download($path);
}
// Hiển thị trang upload home
    public function showUploadHome()
    {
        return view('Image.uploadhome');
    }

    // Xử lý upload file qua kéo thả
    public function uploadDragDrop(Request $request)
    {
       // Validate các file
    $request->validate([
        'files.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Giới hạn 10MB mỗi file
    ]);

    $paths = []; // Mảng chứa đường dẫn các file

    // Kiểm tra và lưu từng file vào thư mục "public/uploads"
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('uploads', 'public'); // Lưu file vào storage
            $paths[] = '/storage/' . $path; // Thêm đường dẫn file vào mảng
        }
    }

    // Trả về đường dẫn các file đã tải lên
    return response()->json([
        'success' => true,
        'paths' => $paths,
    ]);
    }
}
