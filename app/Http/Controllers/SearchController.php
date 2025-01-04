<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    // Phương thức tìm kiếm bài viết
    public function search(Request $request)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tìm kiếm');
        }

        // Xác thực dữ liệu tìm kiếm
        $request->validate([
            'query' => 'required|string|min:3', // Yêu cầu tìm kiếm ít nhất 3 ký tự
        ]);

        // Lưu lịch sử tìm kiếm vào bảng search_histories
        $searchQuery = $request->input('query');
        
        // Lưu lịch sử tìm kiếm trực tiếp
        SearchHistory::create([
            'user_id' => Auth::id(),
            'search_query' => $searchQuery
        ]);

        // Tìm kiếm bài viết theo tiêu đề hoặc nội dung
        $results = Blog::where('title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('content', 'like', '%' . $searchQuery . '%')
                        ->get();

        // Trả về view với kết quả tìm kiếm
        return view('search.index', compact('results', 'searchQuery'));
    }
}

?>