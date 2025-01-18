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
       
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tìm kiếm');
        }

        
        $request->validate([
            'query' => 'required|string|min:3', 
        ]);

       
        $searchQuery = $request->input('query');
        
        
        SearchHistory::create([
            'user_id' => Auth::id(),
            'search_query' => $searchQuery
        ]);

      
        $results = Blog::where('title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('content', 'like', '%' . $searchQuery . '%')
                        ->get();

      
        return view('search.index', compact('results', 'searchQuery'));
    }
}

?>