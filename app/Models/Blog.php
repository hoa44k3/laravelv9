<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 
class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'image_path', 'user_id', 'status','likes', 'comment_count','category_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class,'blog_id');
    }
    public function category()
    {
         return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function totalLikes()
    {
         return $this->likes()->count(); // Tổng số lượt thích
    }

    public function totalComments()
    {
         return $this->comments()->count(); // Tổng số bình luận
    }
    public function totalUsers()
    {
         return $this->users()->count(); // Tổng số người dùng đăng ký
    }
    public function getImagePathAttribute($value)
    {
        return $value ? asset($value) : null; // Trả về đường dẫn chính xác
    }
    public function getExcerptAttribute()
    {
        return Str::limit($this->content, 150); // Lấy 150 ký tự đầu tiên của nội dung bài viết
    }

}
