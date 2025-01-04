<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;
    protected $table = 'search_histories';

    // Định nghĩa các cột có thể được gán (fillable) hoặc không thể gán (guarded)
    protected $fillable = [
        'user_id',
        'search_query',
    ];

    // Định nghĩa mối quan hệ với User (một lịch sử tìm kiếm thuộc về một người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
