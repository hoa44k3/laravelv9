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
         return $this->likes()->count(); 
    }

    public function totalComments()
    {
         return $this->comments()->count(); 
    }
    public function totalUsers()
    {
         return $this->users()->count(); 
    }
    public function getImagePathAttribute($value)
    {
        return $value ? asset($value) : null; 
    }
    public function getExcerptAttribute()
    {
        return Str::limit($this->content, 150); 
    }
    public function tags()
    {
        return $this->hasMany(Tag::class, 'blog_id');
    }
    
}
